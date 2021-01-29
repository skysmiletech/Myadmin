/*!
 * JavaScript Color picker from Mozilla
 *
 * @source https://github.com/mdn/content/blob/996f4e99ba32a9d06bdeeaaa5f9222827a6f054b/files/en-us/web/css/css_colors/color_picker_tool/index.html
 *
 * @license-source https://github.com/mdn/content/blob/main/LICENSE.md#added-on-or-after-august-20-2010
 *
 * @license CC0 1.0 Universal (Public domain)
 */

'use strict';

var globalChange = 0;
var UIColorPicker = (function UIColorPicker() {

    function getElemById(id) {
        return document.getElementById(id);
    }

    var subscribers = [];
    var pickers = [];

    /**
     * RGBA Color class
     *
     * HSV/HSB and HSL (hue, saturation, value / brightness, lightness)
     * @param hue			0-360
     * @param saturation	0-100
     * @param value 		0-100
     * @param lightness		0-100
     */

    function Color(color) {

        if(color instanceof Color === true) {
            this.copy(color);
            return;
        }

        this.r = 0;
        this.g = 0;
        this.b = 0;
        this.a = 1;
        this.hue = 0;
        this.saturation = 0;
        this.value = 0;
        this.lightness = 0;
        this.format = 'HSB';
    }

    function RGBColor(r, g, b) {
        var color = new Color();
        color.setRGBA(r, g, b, 1);
        return color;
    }

    function RGBAColor(r, g, b, a) {
        var color = new Color();
        color.setRGBA(r, g, b, a);
        return color;
    }

    function HSBColor (h, s, v) {
        var color = new Color();
        color.setHSB(h, s, v);
        return color;
    }

    function HSBAColor (h, s, v, a) {
        var color = new Color();
        color.setHSB(h, s, v);
        color.a = a;
        return color;
    }

    function HSLColor (h, s, l) {
        var color = new Color();
        color.setHSL(h, s, l);
        return color;
    }

    function HSLAColor (h, s, l, a) {
        var color = new Color();
        color.setHSL(h, s, l);
        color.a = a;
        return color;
    }

    Color.prototype.copy = function copy(obj) {
        if(obj instanceof Color !== true) {
            console.log('Typeof parameter not Color');
            return;
        }

        this.r = obj.r;
        this.g = obj.g;
        this.b = obj.b;
        this.a = obj.a;
        this.hue = obj.hue;
        this.saturation = obj.saturation;
        this.value = obj.value;
        this.format = '' + obj.format;
        this.lightness = obj.lightness;
    };

    Color.prototype.setFormat = function setFormat(format) {
        if (format === 'HSB')
            this.format = 'HSB';
        if (format === 'HSL')
            this.format = 'HSL';
    };

    /*========== Methods to set Color Properties ==========*/

    Color.prototype.isValidRGBValue = function isValidRGBValue(value) {
        return (typeof(value) === 'number' && isNaN(value) === false &&
            value >= 0 && value <= 255);
    };

    Color.prototype.setRGBA = function setRGBA(red, green, blue, alpha) {
        if (this.isValidRGBValue(red) === false ||
            this.isValidRGBValue(green) === false ||
            this.isValidRGBValue(blue) === false)
            return;

        this.r = red | 0;
        this.g = green | 0;
        this.b = blue | 0;

        if (this.isValidRGBValue(alpha) === true)
            this.a = alpha | 0;
    };

    Color.prototype.setByName = function setByName(name, value) {
        if (name === 'r' || name === 'g' || name === 'b') {
            if(this.isValidRGBValue(value) === false)
                return;

            this[name] = value;
            this.updateHSX();
        }
    };

    Color.prototype.setHSB = function setHSB(hue, saturation, value) {
        this.hue = hue;
        this.saturation = saturation;
        this.value = value;
        this.HSBtoRGB();
    };

    Color.prototype.setHSL = function setHSL(hue, saturation, lightness) {
        this.hue = hue;
        this.saturation = saturation;
        this.lightness = lightness;
        this.HSLtoRGB();
    };

    Color.prototype.setHue = function setHue(value) {
        if (typeof(value) !== 'number' || isNaN(value) === true ||
            value < 0 || value > 359)
            return;
        this.hue = value;
        this.updateRGB();
    };

    Color.prototype.setSaturation = function setSaturation(value) {
        if (typeof(value) !== 'number' || isNaN(value) === true ||
            value < 0 || value > 100)
            return;
        this.saturation = value;
        this.updateRGB();
    };

    Color.prototype.setValue = function setValue(value) {
        if (typeof(value) !== 'number' || isNaN(value) === true ||
            value < 0 || value > 100)
            return;
        this.value = value;
        this.HSBtoRGB();
    };

    Color.prototype.setLightness = function setLightness(value) {
        if (typeof(value) !== 'number' || isNaN(value) === true ||
            value < 0 || value > 100)
            return;
        this.lightness = value;
        this.HSLtoRGB();
    };

    Color.prototype.setHexa = function setHexa(value) {
        var valid  = /(^#{0,1}[0-9A-F]{6}$)|(^#{0,1}[0-9A-F]{3}$)/i.test(value);

        if (valid !== true)
            return;

        if (value[0] === '#')
            value = value.slice(1, value.length);

        if (value.length === 3)
            value = value.replace(/([0-9A-F])([0-9A-F])([0-9A-F])/i,'$1$1$2$2$3$3');

        this.r = parseInt(value.substr(0, 2), 16);
        this.g = parseInt(value.substr(2, 2), 16);
        this.b = parseInt(value.substr(4, 2), 16);

        this.alpha	= 1;
        this.RGBtoHSB();
    };

    /*========== Conversion Methods ==========*/

    Color.prototype.convertToHSL = function convertToHSL() {
        if (this.format === 'HSL')
            return;

        this.setFormat('HSL');
        this.RGBtoHSL();
    };

    Color.prototype.convertToHSB = function convertToHSB() {
        if (this.format === 'HSB')
            return;

        this.setFormat('HSB');
        this.RGBtoHSB();
    };

    /*========== Update Methods ==========*/

    Color.prototype.updateRGB = function updateRGB() {
        if (this.format === 'HSB') {
            this.HSBtoRGB();
            return;
        }

        if (this.format === 'HSL') {
            this.HSLtoRGB();
            return;
        }
    };

    Color.prototype.updateHSX = function updateHSX() {
        if (this.format === 'HSB') {
            this.RGBtoHSB();
            return;
        }

        if (this.format === 'HSL') {
            this.RGBtoHSL();
            return;
        }
    };

    Color.prototype.HSBtoRGB = function HSBtoRGB() {
        var sat = this.saturation / 100;
        var value = this.value / 100;
        var C = sat * value;
        var H = this.hue / 60;
        var X = C * (1 - Math.abs(H % 2 - 1));
        var m = value - C;
        var precision = 255;

        C = (C + m) * precision | 0;
        X = (X + m) * precision | 0;
        m = m * precision | 0;

        if (H >= 0 && H < 1) {	this.setRGBA(C, X, m);	return; }
        if (H >= 1 && H < 2) {	this.setRGBA(X, C, m);	return; }
        if (H >= 2 && H < 3) {	this.setRGBA(m, C, X);	return; }
        if (H >= 3 && H < 4) {	this.setRGBA(m, X, C);	return; }
        if (H >= 4 && H < 5) {	this.setRGBA(X, m, C);	return; }
        if (H >= 5 && H < 6) {	this.setRGBA(C, m, X);	return; }
    };

    Color.prototype.HSLtoRGB = function HSLtoRGB() {
        var sat = this.saturation / 100;
        var light = this.lightness / 100;
        var C = sat * (1 - Math.abs(2 * light - 1));
        var H = this.hue / 60;
        var X = C * (1 - Math.abs(H % 2 - 1));
        var m = light - C/2;
        var precision = 255;

        C = (C + m) * precision | 0;
        X = (X + m) * precision | 0;
        m = m * precision | 0;

        if (H >= 0 && H < 1) {	this.setRGBA(C, X, m);	return; }
        if (H >= 1 && H < 2) {	this.setRGBA(X, C, m);	return; }
        if (H >= 2 && H < 3) {	this.setRGBA(m, C, X);	return; }
        if (H >= 3 && H < 4) {	this.setRGBA(m, X, C);	return; }
        if (H >= 4 && H < 5) {	this.setRGBA(X, m, C);	return; }
        if (H >= 5 && H < 6) {	this.setRGBA(C, m, X);	return; }
    };

    Color.prototype.RGBtoHSB = function RGBtoHSB() {
        var red		= this.r / 255;
        var green	= this.g / 255;
        var blue	= this.b / 255;

        var cmax = Math.max(red, green, blue);
        var cmin = Math.min(red, green, blue);
        var delta = cmax - cmin;
        var hue = 0;
        var saturation = 0;

        if (delta) {
            if (cmax === red ) { hue = ((green - blue) / delta); }
            if (cmax === green ) { hue = 2 + (blue - red) / delta; }
            if (cmax === blue ) { hue = 4 + (red - green) / delta; }
            if (cmax) saturation = delta / cmax;
        }

        this.hue = 60 * hue | 0;
        if (this.hue < 0) this.hue += 360;
        this.saturation = (saturation * 100) | 0;
        this.value = (cmax * 100) | 0;
    };

    Color.prototype.RGBtoHSL = function RGBtoHSL() {
        var red		= this.r / 255;
        var green	= this.g / 255;
        var blue	= this.b / 255;

        var cmax = Math.max(red, green, blue);
        var cmin = Math.min(red, green, blue);
        var delta = cmax - cmin;
        var hue = 0;
        var saturation = 0;
        var lightness = (cmax + cmin) / 2;
        var X = (1 - Math.abs(2 * lightness - 1));

        if (delta) {
            if (cmax === red ) { hue = ((green - blue) / delta); }
            if (cmax === green ) { hue = 2 + (blue - red) / delta; }
            if (cmax === blue ) { hue = 4 + (red - green) / delta; }
            if (cmax) saturation = delta / X;
        }

        this.hue = 60 * hue | 0;
        if (this.hue < 0) this.hue += 360;
        this.saturation = (saturation * 100) | 0;
        this.lightness = (lightness * 100) | 0;
    };

    /*========== Get Methods ==========*/

    Color.prototype.getHexa = function getHexa() {
        var r = this.r.toString(16);
        var g = this.g.toString(16);
        var b = this.b.toString(16);
        if (this.r < 16) r = '0' + r;
        if (this.g < 16) g = '0' + g;
        if (this.b < 16) b = '0' + b;
        var value = '#' + r + g + b;
        return value.toUpperCase();
    };

    Color.prototype.getRGBA = function getRGBA() {

        var rgb = '(' + this.r + ', ' + this.g + ', ' + this.b;
        var a = '';
        var v = '';
        var x = parseFloat(this.a);
        if (x !== 1) {
            a = 'a';
            v = ', ' + x;
        }

        var value = 'rgb' + a + rgb + v + ')';
        return value;
    };

    Color.prototype.getHSLA = function getHSLA() {
        if (this.format === 'HSB') {
            var color = new Color(this);
            color.setFormat('HSL');
            color.updateHSX();
            return color.getHSLA();
        }

        var a = '';
        var v = '';
        var hsl = '(' + this.hue + ', ' + this.saturation + '%, ' + this.lightness +'%';
        var x = parseFloat(this.a);
        if (x !== 1) {
            a = 'a';
            v = ', ' + x;
        }

        var value = 'hsl' + a + hsl + v + ')';
        return value;
    };

    Color.prototype.getColor = function getColor() {
        if (this.a | 0 === 1)
            return this.getHexa();
        return this.getRGBA();
    };

    /*=======================================================================*/
    /*=======================================================================*/

    /*========== Capture Mouse Movement ==========*/

    var setMouseTracking = function setMouseTracking(elem, callback) {
        elem.addEventListener('mousedown', function(e) {
            callback(e);
            document.addEventListener('mousemove', callback);
        });

        document.addEventListener('mouseup', function(e) {
            document.removeEventListener('mousemove', callback);
        });
    };

    /*====================*/
    // Color Picker Class
    /*====================*/

    function ColorPicker(node) {
        this.color = new Color();
        this.node = node;
        this.subscribers = [];

        var type = this.node.getAttribute('data-mode');
        var topic = this.node.getAttribute('data-topic');

        this.topic = topic;
        this.picker_mode = (type === 'HSL') ? 'HSL' : 'HSB';
        this.color.setFormat(this.picker_mode);

        this.createPickingArea();
        this.createHueArea();

        this.newInputComponent('H', 'hue', this.inputChangeHue.bind(this));
        this.newInputComponent('S', 'saturation', this.inputChangeSaturation.bind(this));
        this.newInputComponent('B', 'value', this.inputChangeValue.bind(this));
        this.newInputComponent('L', 'lightness', this.inputChangeLightness.bind(this));

        this.newInputComponent('R', 'red', this.inputChangeRed.bind(this));
        this.newInputComponent('G', 'green', this.inputChangeGreen.bind(this));
        this.newInputComponent('B', 'blue', this.inputChangeBlue.bind(this));

        this.createPreviewBox();

        this.newInputComponent('hexa', 'hexa', this.inputChangeHexa.bind(this));

        this.setColor(this.color);
        pickers[topic] = this;
    }

    /*************************************************************************/
    //				Function for generating the color-picker
    /*************************************************************************/

    ColorPicker.prototype.createPickingArea = function createPickingArea() {
        var area = document.createElement('div');
        var picker = document.createElement('div');

        area.className = 'picking-area';
        picker.className = 'picker';

        this.pickingArea = area;
        this.colorPicker = picker;
        setMouseTracking(area, this.updateColor.bind(this));

        area.appendChild(picker);
        this.node.appendChild(area);
    };

    ColorPicker.prototype.createHueArea = function createHueArea() {
        var area = document.createElement('div');
        var picker = document.createElement('div');

        area.className = 'hue';
        picker.className ='slider-picker';

        this.hueArea = area;
        this.huePicker = picker;
        setMouseTracking(area, this.updateHueSlider.bind(this));

        area.appendChild(picker);
        this.node.appendChild(area);
    };

    ColorPicker.prototype.createAlphaArea = function createAlphaArea() {
        var area = document.createElement('div');
        var mask = document.createElement('div');
        var picker = document.createElement('div');

        area.className = 'alpha';
        mask.className = 'alpha-mask';
        picker.className = 'slider-picker';

        this.alphaArea = area;
        this.alpha_mask = mask;
        this.alpha_picker = picker;
        setMouseTracking(area, this.updateAlphaSlider.bind(this));

        area.appendChild(mask);
        mask.appendChild(picker);
        this.node.appendChild(area);
    };

    ColorPicker.prototype.createPreviewBox = function createPreviewBox(e) {
        var preview_box = document.createElement('div');
        var preview_color = document.createElement('div');

        preview_box.className = 'preview';
        preview_color.className = 'preview-color';

        this.preview_color = preview_color;

        preview_box.appendChild(preview_color);
        this.node.appendChild(preview_box);
    };

    ColorPicker.prototype.newInputComponent = function newInputComponent(title, topic, onChangeFunc) {
        var wrapper = document.createElement('div');
        var input = document.createElement('input');
        var info = document.createElement('span');

        wrapper.className = 'input';
        wrapper.setAttribute('data-topic', topic);
        info.textContent = title;
        info.className = 'name';
        input.setAttribute('type', 'text');

        wrapper.appendChild(info);
        wrapper.appendChild(input);
        this.node.appendChild(wrapper);

        input.addEventListener('change', onChangeFunc);
        input.addEventListener('click', function() {
            this.select();
        });

        this.subscribe(topic, function(value) {
            input.value = value;
        });
    };

    // ColorPicker.prototype.createChangeModeButton = function createChangeModeButton() {
    //
    //     var button = document.createElement('div');
    //     button.className = 'switch_mode';
    //     button.addEventListener('click', function() {
    //         if (this.picker_mode === 'HSV')
    //             this.setPickerMode('HSL');
    //         else
    //             this.setPickerMode('HSV');
    //
    //     }.bind(this));
    //
    //     this.node.appendChild(button);
    // };

    /*************************************************************************/
    //					Updates properties of UI elements
    /*************************************************************************/

    ColorPicker.prototype.updateColor = function updateColor(e) {
        var x = e.pageX - this.pickingArea.offsetLeft
            - this.pickingArea.offsetParent.offsetLeft - this.pickingArea.offsetParent.offsetParent.offsetLeft;
        var y = e.pageY - this.pickingArea.offsetTop
            - this.pickingArea.offsetParent.offsetTop - this.pickingArea.offsetParent.offsetParent.offsetTop;
        var picker_offset = 5;

        // width and height should be the same
        var size = this.pickingArea.clientWidth;

        if (x > size) x = size;
        if (y > size) y = size;
        if (x < 0) x = 0;
        if (y < 0) y = 0;

        var value = 100 - (y * 100 / size) | 0;
        var saturation = x * 100 / size | 0;

        if (this.picker_mode === 'HSB')
            this.color.setHSB(this.color.hue, saturation, value);
        if (this.picker_mode === 'HSL')
            this.color.setHSL(this.color.hue, saturation, value);

        this.colorPicker.style.left = x - picker_offset + 'px';
        this.colorPicker.style.top = y - picker_offset + 'px';

        // this.updateAlphaGradient();
        this.updatePreviewColor();

        this.notify('value', value);
        this.notify('lightness', value);
        this.notify('saturation', saturation);

        this.notify('red', this.color.r);
        this.notify('green', this.color.g);
        this.notify('blue', this.color.b);
        this.notify('hexa', this.color.getHexa());

        notify(this.topic, this.color);
    };

    ColorPicker.prototype.updateHueSlider = function updateHueSlider(e) {
        var x = e.pageX - this.hueArea.offsetLeft
            - this.hueArea.offsetParent.offsetLeft - this.hueArea.offsetParent.offsetParent.offsetLeft;
        var width = this.hueArea.clientWidth;

        if (x < 0) x = 0;
        if (x > width) x = width;

        // TODO 360 => 359
        var hue = ((359 * x) / width) | 0;
        // if (hue === 360) hue = 359;

        this.updateSliderPosition(this.huePicker, x);
        this.setHue(hue);
    };

    // ColorPicker.prototype.updateAlphaSlider = function updateAlphaSlider(e) {
    //     var x = e.pageX - this.alphaArea.offsetLeft;
    //     var width = this.alphaArea.clientWidth;
    //
    //     if (x < 0) x = 0;
    //     if (x > width) x = width;
    //
    //     this.color.a = (x / width).toFixed(2);
    //
    //     this.updateSliderPosition(this.alpha_picker, x);
    //     this.updatePreviewColor();
    //
    //     this.notify('alpha', this.color.a);
    //     notify(this.topic, this.color);
    // };

    ColorPicker.prototype.setHue = function setHue(value) {
        this.color.setHue(value);

        this.updatePickerBackground();
        this.updatePreviewColor();

        this.notify('red', this.color.r);
        this.notify('green', this.color.g);
        this.notify('blue', this.color.b);
        this.notify('hexa', this.color.getHexa());
        this.notify('hue', this.color.hue);

        notify(this.topic, this.color);
    };

    // Updates when one of Saturation/Value/Lightness changes
    ColorPicker.prototype.updateSLV = function updateSLV() {
        this.updatePickerPosition();
        this.updateAlphaGradient();
        this.updatePreviewColor();

        this.notify('red', this.color.r);
        this.notify('green', this.color.g);
        this.notify('blue', this.color.b);
        this.notify('hexa', this.color.getHexa());

        notify(this.topic, this.color);
    };

    /*************************************************************************/
    //				Update positions of various UI elements
    /*************************************************************************/

    ColorPicker.prototype.updatePickerPosition = function updatePickerPosition() {
        var size = this.pickingArea.clientWidth;
        var value = 0;
        var offset = 5;

        if (this.picker_mode === 'HSB')
            value = this.color.value;
        if (this.picker_mode === 'HSL')
            value = this.color.lightness;

        var x = (this.color.saturation * size / 100) | 0;
        var y = size - (value * size / 100) | 0;

        this.colorPicker.style.left = x - offset + 'px';
        this.colorPicker.style.top = y - offset + 'px';
    };

    ColorPicker.prototype.updateSliderPosition = function updateSliderPosition(elem, pos) {
        elem.style.left = Math.max(pos - 3, -2) + 'px';
    };

    ColorPicker.prototype.updateHuePicker = function updateHuePicker() {
        var size = this.hueArea.clientWidth;
        var offset = 1;
        var pos = (this.color.hue * size / 360 ) | 0;
        this.huePicker.style.left = pos - offset + 'px';
    };

    // ColorPicker.prototype.updateAlphaPicker = function updateAlphaPicker() {
    //     var size = this.alphaArea.clientWidth;
    //     var offset = 1;
    //     var pos = (this.color.a * size) | 0;
    //     this.alpha_picker.style.left = pos - offset + 'px';
    // };

    /*************************************************************************/
    //						Update background colors
    /*************************************************************************/

    ColorPicker.prototype.updatePickerBackground = function updatePickerBackground() {
        var nc = new Color(this.color);
        nc.setHSB(nc.hue, 100, 100);
        this.pickingArea.style.backgroundColor = nc.getHexa();
    };

    // ColorPicker.prototype.updateAlphaGradient = function updateAlphaGradient() {
    //     this.alpha_mask.style.backgroundColor = this.color.getHexa();
    // };

    ColorPicker.prototype.updatePreviewColor = function updatePreviewColor() {
        this.preview_color.style.backgroundColor = this.color.getColor();
    };

    /*************************************************************************/
    //						Update input elements
    /*************************************************************************/

    ColorPicker.prototype.inputChangeHue = function inputChangeHue(e) {
        var value = parseInt(e.target.value);
        this.setHue(value);
        this.updateHuePicker();
    };

    ColorPicker.prototype.inputChangeSaturation = function inputChangeSaturation(e) {
        var value = parseInt(e.target.value);
        this.color.setSaturation(value);
        e.target.value = this.color.saturation;
        this.updateSLV();
    };

    ColorPicker.prototype.inputChangeValue = function inputChangeValue(e) {
        var value = parseInt(e.target.value);
        this.color.setValue(value);
        e.target.value = this.color.value;
        this.updateSLV();
    };

    ColorPicker.prototype.inputChangeLightness = function inputChangeLightness(e) {
        var value = parseInt(e.target.value);
        this.color.setLightness(value);
        e.target.value = this.color.lightness;
        this.updateSLV();
    };

    ColorPicker.prototype.inputChangeRed = function inputChangeRed(e) {
        var value = parseInt(e.target.value);
        this.color.setByName('r', value);
        e.target.value = this.color.r;
        this.setColor(this.color);
    };

    ColorPicker.prototype.inputChangeGreen = function inputChangeGreen(e) {
        var value = parseInt(e.target.value);
        this.color.setByName('g', value);
        e.target.value = this.color.g;
        this.setColor(this.color);
    };

    ColorPicker.prototype.inputChangeBlue = function inputChangeBlue(e) {
        var value = parseInt(e.target.value);
        this.color.setByName('b', value);
        e.target.value = this.color.b;
        this.setColor(this.color);
    };

    ColorPicker.prototype.inputChangeAlpha = function inputChangeAlpha(e) {
        var value = parseFloat(e.target.value);

        if (typeof value === 'number' && isNaN(value) === false &&
            value >= 0 && value <= 1)
            this.color.a = value.toFixed(2);

        e.target.value = this.color.a;
        this.updateAlphaPicker();
    };

    ColorPicker.prototype.inputChangeHexa = function inputChangeHexa(e) {
        var value = e.target.value;
        this.color.setHexa(value);
        this.setColor(this.color);
    };

    /*************************************************************************/
    //							Internal Pub/Sub
    /*************************************************************************/

    ColorPicker.prototype.subscribe = function subscribe(topic, callback) {
        this.subscribers[topic] = callback;
    };

    ColorPicker.prototype.notify = function notify(topic, value) {
        if (this.subscribers[topic])
            this.subscribers[topic](value);
    };

    /*************************************************************************/
    //							Set Picker Properties
    /*************************************************************************/

    ColorPicker.prototype.setColor = function setColor(color) {
        if(color instanceof Color !== true) {
            console.log('Typeof parameter not Color');
            return;
        }

        if (color.format !== this.picker_mode) {
            color.setFormat(this.picker_mode);
            color.updateHSX();
        }

        this.color.copy(color);
        this.updateHuePicker();
        this.updatePickerPosition();
        this.updatePickerBackground();
        // this.updateAlphaPicker();
        // this.updateAlphaGradient();
        this.updatePreviewColor();

        this.notify('red', this.color.r);
        this.notify('green', this.color.g);
        this.notify('blue', this.color.b);

        this.notify('hue', this.color.hue);
        this.notify('saturation', this.color.saturation);
        this.notify('value', this.color.value);
        this.notify('lightness', this.color.lightness);

        this.notify('alpha', this.color.a);
        this.notify('hexa', this.color.getHexa());
        notify(this.topic, this.color);
    };

    ColorPicker.prototype.setPickerMode = function setPickerMode(mode) {
        if (mode !== 'HSB' && mode !== 'HSL')
            return;

        this.picker_mode = mode;
        this.node.setAttribute('data-mode', this.picker_mode);
        this.setColor(this.color);
    };

    /*************************************************************************/
    //								UNUSED
    /*************************************************************************/

    var setPickerMode = function setPickerMode(topic, mode) {
        if (pickers[topic])
            pickers[topic].setPickerMode(mode);
    };

    var setColor = function setColor(topic, color) {
        if (pickers[topic])
            pickers[topic].setColor(color);
    };

    var getColor = function getColor(topic) {
        if (pickers[topic])
            return new Color(pickers[topic].color);
    };

    var subscribe = function subscribe(topic, callback) {
        if (subscribers[topic] === undefined)
            subscribers[topic] = [];

        subscribers[topic].push(callback);
    };

    var unsubscribe = function unsubscribe(callback) {
        subscribers.indexOf(callback);
        subscribers.splice(index, 1);
    };

    var notify = function notify(topic, value) {
        if (subscribers[topic] === undefined || subscribers[topic].length === 0)
            return;

        var color = new Color(value);
        for (var i in subscribers[topic])
            subscribers[topic][i](color);
    };

    var init = function init() {
        var elem = document.querySelectorAll('.ui-color-picker');
        var size = elem.length;
        for (var i = 0; i < size; i++)
            new ColorPicker(elem[i]);
    };

    return {
        init : init,
        Color : Color,
        RGBColor : RGBColor,
        RGBAColor : RGBAColor,
        HSBColor : HSBColor,
        HSBAColor : HSBAColor,
        HSLColor : HSLColor,
        HSLAColor : HSLAColor,
        setColor : setColor,
        getColor : getColor,
        subscribe : subscribe,
        unsubscribe : unsubscribe,
        setPickerMode : setPickerMode
    };

})();

/**
 * UI-SlidersManager
 */

var InputSliderManager = (function InputSliderManager() {

    var subscribers = {};
    var sliders = [];

    var InputComponent = function InputComponent(obj) {
        var input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.style.width = 50 + obj.precision * 10 + 'px';

        input.addEventListener('click', function(e) {
            this.select();
        });

        input.addEventListener('change', function(e) {
            var value = parseFloat(e.target.value);

            if (isNaN(value) === true)
                setValue(obj.topic, obj.value);
            else
                setValue(obj.topic, value);
        });

        return input;
    };

    var SliderComponent = function SliderComponent(obj, sign) {
        var slider = document.createElement('div');
        var startX = null;
        var start_value = 0;

        slider.addEventListener("click", function(e) {
            document.removeEventListener("mousemove", sliderMotion);
            setValue(obj.topic, obj.value + obj.step * sign);
        });

        slider.addEventListener("mousedown", function(e) {
            startX = e.clientX;
            start_value = obj.value;
            document.body.style.cursor = "e-resize";

            document.addEventListener("mouseup", slideEnd);
            document.addEventListener("mousemove", sliderMotion);
        });

        var slideEnd = function slideEnd(e) {
            document.removeEventListener("mousemove", sliderMotion);
            document.body.style.cursor = "auto";
            slider.style.cursor = "pointer";
        };

        var sliderMotion = function sliderMotion(e) {
            slider.style.cursor = "e-resize";
            var delta = (e.clientX - startX) / obj.sensitivity | 0;
            var value = delta * obj.step + start_value;
            setValue(obj.topic, value);
        };

        return slider;
    };

    var InputSlider = function(node) {
        var min		= parseFloat(node.getAttribute('data-min'));
        var max		= parseFloat(node.getAttribute('data-max'));
        var step	= parseFloat(node.getAttribute('data-step'));
        var value	= parseFloat(node.getAttribute('data-value'));
        var topic	= node.getAttribute('data-topic');
        var unit	= node.getAttribute('data-unit');
        var name 	= node.getAttribute('data-info');
        var sensitivity = node.getAttribute('data-sensitivity') | 0;
        var precision = node.getAttribute('data-precision') | 0;

        this.min = isNaN(min) ? 0 : min;
        this.max = isNaN(max) ? 100 : max;
        this.precision = precision >= 0 ? precision : 0;
        this.step = step < 0 || isNaN(step) ? 1 : step.toFixed(precision);
        this.topic = topic;
        this.node = node;
        this.unit = unit === null ? '' : unit;
        this.sensitivity = sensitivity > 0 ? sensitivity : 5;
        value = isNaN(value) ? this.min : value;

        var input = new InputComponent(this);
        var slider_left  = new SliderComponent(this, -1);
        var slider_right = new SliderComponent(this,  1);

        slider_left.className = 'ui-input-slider-left';
        slider_right.className = 'ui-input-slider-right';

        if (name) {
            var info = document.createElement('span');
            info.className = 'ui-input-slider-info';
            info.textContent = name;
            node.appendChild(info);
        }

        node.appendChild(slider_left);
        node.appendChild(input);
        node.appendChild(slider_right);

        this.input = input;
        sliders[topic] = this;
        setValue(topic, value);
    };

    InputSlider.prototype.setInputValue = function setInputValue() {
        this.input.value = this.value.toFixed(this.precision) + this.unit;
    };

    var setValue = function setValue(topic, value, send_notify) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        value = parseFloat(value.toFixed(slider.precision));

        if (value > slider.max) value = slider.max;
        if (value < slider.min)	value = slider.min;

        slider.value = value;
        slider.node.setAttribute('data-value', value);

        slider.setInputValue();

        if (send_notify === false)
            return;

        notify.call(slider);
    };

    var setMax = function setMax(topic, value) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        slider.max = value;
        setValue(topic, slider.value);
    };

    var setMin = function setMin(topic, value) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        slider.min = value;
        setValue(topic, slider.value);
    };

    var setUnit = function setUnit(topic, unit) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        slider.unit = unit;
        setValue(topic, slider.value);
    };

    var setStep = function setStep(topic, value) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        slider.step = parseFloat(value);
        setValue(topic, slider.value);
    };

    var setPrecision = function setPrecision(topic, value) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        value = value | 0;
        slider.precision = value;

        var step = parseFloat(slider.step.toFixed(value));
        if (step === 0)
            slider.step = 1 / Math.pow(10, value);

        setValue(topic, slider.value);
    };

    var setSensitivity = function setSensitivity(topic, value) {
        var slider = sliders[topic];
        if (slider === undefined)
            return;

        value = value | 0;

        slider.sensitivity = value > 0 ? value : 5;
    };

    var getNode =  function getNode(topic) {
        return sliders[topic].node;
    };

    var getPrecision =  function getPrecision(topic) {
        return sliders[topic].precision;
    };

    var getStep =  function getStep(topic) {
        return sliders[topic].step;
    };

    var subscribe = function subscribe(topic, callback) {
        if (subscribers[topic] === undefined)
            subscribers[topic] = [];
        subscribers[topic].push(callback);
    };

    var unsubscribe = function unsubscribe(topic, callback) {
        subscribers[topic].indexOf(callback);
        subscribers[topic].splice(index, 1);
    };

    var notify = function notify() {
        if (subscribers[this.topic] === undefined)
            return;
        for (var i = 0; i < subscribers[this.topic].length; i++)
            subscribers[this.topic][i](this.value);
    };

    var createSlider = function createSlider(topic, label) {
        var slider = document.createElement('div');
        slider.className = 'ui-input-slider';
        slider.setAttribute('data-topic', topic);

        if (label !== undefined)
            slider.setAttribute('data-info', label);

        new InputSlider(slider);
        return slider;
    };

    var init = function init() {
        var elem = document.querySelectorAll('.ui-input-slider');
        var size = elem.length;
        for (var i = 0; i < size; i++)
            new InputSlider(elem[i]);
    };

    return {
        init : init,
        setMax : setMax,
        setMin : setMin,
        setUnit : setUnit,
        setStep : setStep,
        getNode : getNode,
        getStep : getStep,
        setValue : setValue,
        subscribe : subscribe,
        unsubscribe : unsubscribe,
        setPrecision : setPrecision,
        setSensitivity : setSensitivity,
        getPrecision : getPrecision,
        createSlider : createSlider,
    };

})();

'use strict';

// NOTE: Disabled source code, handled in our scripts
//window.addEventListener("load", function() {
//    ColorPickerTool.init();
//});

var ColorPickerTool = (function ColorPickerTool() {

    /*========== Get DOM Element By ID ==========*/

    function getElemById(id) {
        return document.getElementById(id);
    }

    function allowDropEvent(e) {
        e.preventDefault();
    }

    /*========== Make an element resizable relative to it's parent ==========*/

    var UIComponent = (function UIComponent() {

        function makeResizable(elem, axis) {
            var valueX = 0;
            var valueY = 0;
            var action = 0;

            var resizeStart = function resizeStart(e) {
                e.stopPropagation();
                e.preventDefault();
                if (e.button !== 0)
                    return;

                valueX = e.clientX - elem.clientWidth;
                valueY = e.clientY - elem.clientHeight;

                document.body.setAttribute('data-resize', axis);
                document.addEventListener('mousemove', mouseMove);
                document.addEventListener('mouseup', resizeEnd);
            };

            var mouseMove = function mouseMove(e) {
                if (action >= 0)
                    elem.style.width = e.clientX - valueX + 'px';
                if (action <= 0)
                    elem.style.height = e.clientY - valueY + 'px';
            };

            var resizeEnd = function resizeEnd(e) {
                if (e.button !== 0)
                    return;

                document.body.removeAttribute('data-resize', axis);
                document.removeEventListener('mousemove', mouseMove);
                document.removeEventListener('mouseup', resizeEnd);
            };

            var handle = document.createElement('div');
            handle.className = 'resize-handle';

            if (axis === 'width') action = 1;
            else if (axis === 'height') action = -1;
            else axis = 'both';

            handle.className = 'resize-handle';
            handle.setAttribute('data-resize', axis);
            handle.addEventListener('mousedown', resizeStart);
            elem.appendChild(handle);
        };

        /*========== Make an element draggable relative to it's parent ==========*/

        var makeDraggable = function makeDraggable(elem, endFunction) {

            var offsetTop;
            var offsetLeft;

            elem.setAttribute('data-draggable', 'true');

            var dragStart = function dragStart(e) {
                e.preventDefault();
                e.stopPropagation();

                if (e.target.getAttribute('data-draggable') !== 'true' ||
                    e.target !== elem || e.button !== 0)
                    return;

                offsetLeft = e.clientX - elem.offsetLeft;
                offsetTop = e.clientY - elem.offsetTop;

                document.addEventListener('mousemove', mouseDrag);
                document.addEventListener('mouseup', dragEnd);
            };

            var dragEnd = function dragEnd(e) {
                if (e.button !== 0)
                    return;

                document.removeEventListener('mousemove', mouseDrag);
                document.removeEventListener('mouseup', dragEnd);
            };

            var mouseDrag = function mouseDrag(e) {
                elem.style.left = e.clientX - offsetLeft + 'px';
                elem.style.top = e.clientY - offsetTop + 'px';
            };

            elem.addEventListener('mousedown', dragStart, false);
        };

        return {
            makeResizable : makeResizable,
            makeDraggable : makeDraggable
        };

    })();

    /*========== Color Class ==========*/

    var Color = UIColorPicker.Color;
    var HSLColor = UIColorPicker.HSLColor;

    /**
     * ColorPalette
     */
    var ColorPalette = (function ColorPalette() {

        var samples = [];
        var colorPalette;
        var palleteSize = 10;
        var complementary;

        var hideNode = function(node) {
            node.setAttribute('data-hidden', 'true');
        };

        var ColorSample = function ColorSample(id) {
            // ADDED
            var title = [
                'Base Colour',
                'Background Colour',
                'Navigation Panel',
                'Navigation Hover',
                'Hyperlink Text',
                'Table Header and Footer Text Colour',
                'Table Header and Footer Background',
                'Table Row Background',
                'Header',
                'Text Colour'
            ];
            var node = document.createElement('div');
            node.className = 'sample';

            this.uid = samples.length;
            this.node = node;
            this.color = new Color();
            var palleteSize = 10;// ADDED
            var index = this.uid % palleteSize;// ADDED

            node.setAttribute('title', title[index]);// ADDED
            node.setAttribute('sample-id', this.uid);
            node.setAttribute('draggable', 'true');
            node.addEventListener('dragstart', this.dragStart.bind(this));
            node.addEventListener('click', this.pickColor.bind(this));

            samples.push(this);
        };

        ColorSample.prototype.updateBgColor = function updateBgColor() {
            this.node.style.backgroundColor = this.color.getColor();
        };

        ColorSample.prototype.updateColor = function updateColor(color) {
            this.color.copy(color);
            this.updateBgColor();
        };

        ColorSample.prototype.updateTriadic = function updateTriadic (color, size, steps) {
            var h = color.hue;
            var hue;
            var saturation;
            var brightness;
            if ((steps * 3 / size) < 1 || globalChange) {
                hue = h;
            } else if ((steps * 3 / size) < 2) {
                if (h - 120 < 0) {
                    hue = 240 + h;
                } else {
                    hue = h - 120;
                }
            } else {
                if (h + 120 >= 360) {
                    hue = h - 240;
                } else {
                    hue = h + 120;
                }
            }

            if (globalChange) {
                saturation = color.saturation;
                brightness = color.value;
            } else {
                saturation = this.updateSaturation(color.saturation, size / 3, steps % (size / 3));
                brightness = this.updateBrightness(color.value, size / 3, steps % (size / 3));
            }

            if (saturation > 100 || brightness > 100) {
                saturation = 0;
                brightness = 100;
            }
            this.node.removeAttribute('data-hidden');
            this.color.copy(color);
            this.color.setValue(brightness);
            this.color.setSaturation(saturation);
            this.color.setHue(hue);
            this.updateBgColor();
        };

        ColorSample.prototype.updateHue = function updateHue(color, degree, steps) {
            this.color.copy(color);
            var hue = (steps * degree + this.color.hue) % 360;
            if (hue < 0) hue += 360;
            this.color.setHue(hue);
            this.updateBgColor();
        };

        ColorSample.prototype.updateSaturation = function updateSaturation (s, size, steps) {
            var saturation;
            if (steps) {
                if (s < 20) {
                    saturation = 100 - ((100 / size) * steps);
                } else if (3 * s / 2 >= 100) {
                    saturation = (((200 - s) * steps) + (s * (size - 1) - 200)) / (2 * (size - 2));
                } else {
                    saturation = ((s / (size - 2)) * (steps - 1)) + (s / 2);
                }
            } else {
                saturation = s;
            }
            return saturation;
        };

        ColorSample.prototype.updateBrightness = function updateBrightness (b, size, steps) {
            var brightness;
            if (steps) {
                if (b < 20) {
                    brightness = (100 / (size - 1)) * steps;
                } else if (3 * b / 2 >= 100) {
                    brightness = (((200 - b) * (size - steps)) + (b * (size - 1) - 200)) / (2 * (size - 2));
                } else {
                    brightness = ((b / (size - 2)) * ((size - steps) - 1)) + (b / 2);
                }
            } else {
                brightness = b;
            }
            return brightness;
        };

        ColorSample.prototype.updateLightness = function updateLightness(color, value, steps) {
            var lightness = color.lightness + value * steps;
            if (lightness <= 0) {
                this.node.setAttribute('data-hidden', 'true');
                return;
            }
            this.node.removeAttribute('data-hidden');
            this.color.copy(color);
            this.color.setLightness(lightness);
            this.updateBgColor();
        };

        ColorSample.prototype.updateAdjacent = function updateAdjacent (color, size, steps) {
            var h = color.hue;
            var hue;
            var saturation;
            var brightness;
            if ((steps * 3 / size) < 1 || globalChange) {
                hue = h;
            } else if ((steps * 3 / size) < 2) {
                if (h - 60 < 0) {
                    hue = 300 + h;
                } else {
                    hue = h - 60;
                }
            } else {
                if (h + 60 >= 360) {
                    hue = h - 300;
                } else {
                    hue = h + 60;
                }
            }

            if (globalChange) {
                saturation = color.saturation;
                brightness = color.value;
            } else {
                saturation = this.updateSaturation(color.saturation, size / 3, steps % (size / 3));
                brightness = this.updateBrightness(color.value, size / 3, steps % (size / 3));
            }

            if (saturation > 100 || brightness > 100) {
                saturation = 0;
                brightness = 100;
            }

            this.node.removeAttribute('data-hidden');
            this.color.copy(color);
            this.color.setValue(brightness);
            this.color.setSaturation(saturation);
            this.color.setHue(hue);
            this.updateBgColor();
        };

        ColorSample.prototype.updateMonochrome = function updateMonochrome (color, size, steps) {
            var saturation;
            var brightness;
            if (globalChange) {
                saturation = color.saturation;
                brightness = color.value;
            } else {
                saturation = this.updateSaturation(color.saturation, size, steps % (size));
                brightness = this.updateBrightness(color.value, size, steps % (size));
            }

            if (saturation > 100 || brightness > 100) {
                saturation = 0;
                brightness = 100;
            }
            this.node.removeAttribute('data-hidden');
            this.color.copy(color);
            this.color.setValue(brightness);
            this.color.setSaturation(saturation);
            this.updateBgColor();
        };

        ColorSample.prototype.updateComplementary = function updateComplementary (color, size, steps) {
            var h = color.hue;
            var hue;
            var saturation;
            var brightness;
            if ((steps * 2 / size) < 1 || globalChange) {
                hue = h;
            } else {
                if (h  < 180) {
                    hue = h + 180;
                } else {
                    hue = h - 180;
                }
            }

            if (globalChange) {
                saturation = color.saturation;
                brightness = color.value;
            } else {
                saturation = this.updateSaturation(color.saturation, size / 2, steps % (size / 2));
                brightness = this.updateBrightness(color.value, size / 2, steps % (size / 2));
            }

            if (saturation > 100 || brightness > 100) {
                saturation = 0;
                brightness = 100;
            }
            this.node.removeAttribute('data-hidden');
            this.color.copy(color);
            this.color.setValue(brightness);
            this.color.setSaturation(saturation);
            this.color.setHue(hue);
            this.updateBgColor();
        };

        ColorSample.prototype.updateAlpha = function updateAlpha(color, value, steps) {
            var alpha = parseFloat(color.a) + value * steps;
            if (alpha <= 0) {
                this.node.setAttribute('data-hidden', 'true');
                return;
            }
            this.node.removeAttribute('data-hidden');
            this.color.copy(color);
            this.color.a = parseFloat(alpha.toFixed(2));
            this.updateBgColor();
        };

        ColorSample.prototype.pickColor = function pickColor() {
            if (this.uid % palleteSize === 0) {
                globalChange = 0;
            } else {
                globalChange = this.uid;
            }
            UIColorPicker.setColor('picker', this.color);
        };

        ColorSample.prototype.dragStart = function dragStart(e) {
            e.dataTransfer.setData('sampleID', this.uid);
            e.dataTransfer.setData('location', 'palette-samples');
        };

        ColorSample.prototype.improveContrastRatio = function improveContrastRatio (group , background) {
            var brightness = 50;
            var saturation = 50;
            var max1 = 1;
            var max2 = 1;
            var maxBrightness = brightness;
            var maxSaturation = saturation;
            for (var i = 0 ; i < 11 ; i ++) {
                var contrast1 = getColorContrast(this.color,group);
                var contrast2 = getColorContrast(this.color,background);
                if (contrast1 > 4.5 && contrast2 > 4.5) {
                    this.updateBgColor();
                    return;
                }
                if (max1 < contrast1 && max2 < contrast2 && i > 0) {
                    max1 = contrast1;
                    max2 = contrast2;
                    maxBrightness = this.color.value;
                    maxBrightness = this.color.saturation;
                }
                if (i % 2 === 1) {
                    saturation += i * 10;
                } else {
                    saturation = brightness;
                }
                brightness = 100 - saturation;
                this.color.setSaturation(saturation);
                this.color.setValue(brightness);
            }
            this.color.setValue(maxBrightness);
            this.color.setValue(maxSaturation);
            this.updateBgColor();
        };

        var Palette = function Palette(text, size) {
            this.samples = [];
            this.locked = false;

            var palette = document.createElement('div');
            var title = document.createElement('div');
            var controls = document.createElement('div');
            var container = document.createElement('div');
            var lock = document.createElement('div');

            container.className = 'container';
            title.className = 'title';
            palette.className = 'palette';
            controls.className = 'controls';
            lock.className = 'lock';
            title.textContent = text;

            controls.appendChild(lock);
            container.appendChild(title);
            container.appendChild(controls);
            container.appendChild(palette);

            lock.addEventListener('click', function () {
                this.locked = !this.locked;
                lock.setAttribute('locked-state', this.locked);
            }.bind(this));

            for(var i = 0; i < size; i++) {
                var sample = new ColorSample();
                this.samples.push(sample);
                palette.appendChild(sample.node);
            }

            this.container = container;
            this.title = title;
        };

        var paletteTextUpdate = function paletteTextUpdate (palette) {
            if (document.getElementsByName('text_contrast')[0].checked) {
                for (var i = 0; i < palleteSize; i++) {
                    var title = palette.samples[i].node.title;
                    if (title === 'Navigation Panel') {
                        var group = palette.samples[i].color;
                    } if (title === 'Background Colour') {
                        var background = palette.samples[i].color;
                    }
                }
                for (i = 0; i < palleteSize; i++) {
                    title = palette.samples[i].node.title;
                    if (title === 'Text Colour' || title === 'Hyperlink Text') {
                        palette.samples[i].improveContrastRatio(group , background);
                    }
                }
            }
        };

        var createTriadicPalette = function createTriadicPalette () {
            var palette = new Palette('Triadic', palleteSize);
            var i;
            UIColorPicker.subscribe('picker', function (color) {
                if (globalChange / palleteSize > 0 && globalChange / palleteSize < 1) {
                    i = globalChange % palleteSize;
                    palette.samples[i].updateTriadic(color, palleteSize, i);
                } else if (globalChange === 0) {
                    for (i = 0; i < palleteSize; i++) {
                        palette.samples[i].updateTriadic(color, palleteSize, i);
                    }
                }
                paletteTextUpdate (palette);
            });
            var checkbox = document.getElementsByName('text_contrast')[0];
            checkbox.addEventListener('click', function () {
                paletteTextUpdate (palette);
            });

            colorPalette.appendChild(palette.container);
        };

        var createComplementaryPalette = function createComplementaryPalette () {
            var palette = new Palette('Complementary', palleteSize);
            var i;
            UIColorPicker.subscribe('picker', function (color) {
                if (globalChange / palleteSize > 1 && globalChange / palleteSize < 2) {
                    i = globalChange % palleteSize;
                    palette.samples[i].updateComplementary(color, palleteSize, i);
                } else if (globalChange === 0) {
                    for (i = 0; i < palleteSize; i++) {
                        palette.samples[i].updateComplementary(color, palleteSize, i);
                    }
                }
                paletteTextUpdate (palette);
            });
            var checkbox = document.getElementsByName('text_contrast')[0];
            checkbox.addEventListener('click', function () {
                paletteTextUpdate (palette);
            });

            colorPalette.appendChild(palette.container);
        };

        /* Brightness or Lightness - depends on the picker mode */
        var createAdjacentPalette = function createAdjacentPalette () {
            var palette = new Palette('Adjacent', palleteSize);
            var i;
            UIColorPicker.subscribe('picker', function (color) {
                if (globalChange / palleteSize > 2 && globalChange / palleteSize < 3) {
                    i = globalChange % palleteSize;
                    palette.samples[i].updateAdjacent(color, palleteSize, i);
                } else if (globalChange === 0) {
                    for (i = 0; i < palleteSize; i++) {
                        palette.samples[i].updateAdjacent(color, palleteSize, i);
                    }
                }
                paletteTextUpdate (palette);
            });
            var checkbox = document.getElementsByName('text_contrast')[0];
            checkbox.addEventListener('click', function () {
                paletteTextUpdate (palette);
            });

            colorPalette.appendChild(palette.container);
        };

        var createMonochromePalette = function createMonochromePalette () {
            var palette = new Palette('Monochrome', palleteSize);
            var i;
            UIColorPicker.subscribe('picker', function (color) {
                if (globalChange / palleteSize > 3) {
                    i = globalChange % palleteSize;
                    palette.samples[i].updateMonochrome(color, palleteSize, i);
                } else if (globalChange === 0) {
                    for (i = 0; i < palleteSize; i++) {
                        palette.samples[i].updateMonochrome(color, palleteSize, i);
                    }
                }
                paletteTextUpdate (palette);
            });
            var checkbox = document.getElementsByName('text_contrast')[0];
            checkbox.addEventListener('click', function () {
                paletteTextUpdate (palette);
            });

            colorPalette.appendChild(palette.container);
        };

        var getSampleColor = function getSampleColor(id) {
            if (samples[id] !== undefined && samples[id]!== null)
                return new Color(samples[id].color);
        };


        var getColorContrast = function getColorContrast (c1 , c2) {
            var lum1 = luminance(c1.r , c1.g , c1.b) + 0.05;
            var lum2 = luminance(c2.r , c2.g , c2.b) + 0.05;
            if (lum1 / lum2 > 1) {
                return lum1 / lum2;
            } else {
                return lum2 / lum1;
            }
        };

        var luminance = function luminanace (r, g, b) {
            var a = [r, g, b].map(function (v) {
                var newV = v;
                newV /= 255;
                return newV <= 0.03928
                    ? newV / 12.92
                    : Math.pow((newV + 0.055) / 1.055, 2.4);
            });
            return a[0] * 0.2126 + a[1] * 0.7152 + a[2] * 0.0722;
        };

        var init = function init() {
            colorPalette = getElemById('color-palette');

            createTriadicPalette();
            createComplementaryPalette();
            createAdjacentPalette();
            createMonochromePalette();

        };

        return {
            init : init,
            getSampleColor : getSampleColor
        };

    })();

    /**
     * ColorInfo
     */
    var ColorInfo = (function ColorInfo() {

        var info_box;
        var select;
        var RGBA;
        var HEXA;
        var HSLA;

        var updateInfo = function updateInfo(color) {
            if (color.a | 0 === 1) {
                RGBA.info.textContent = 'RGB';
                HSLA.info.textContent = 'HSL';
            }
            else {
                RGBA.info.textContent = 'RGBA';
                HSLA.info.textContent = 'HSLA';
            }

            RGBA.value.value = color.getRGBA();
            HSLA.value.value = color.getHSLA();
            HEXA.value.value = color.getHexa();
        };

        var InfoProperty = function InfoProperty(info) {

            var node = document.createElement('div');
            var title = document.createElement('div');
            var value = document.createElement('input');
            var copy = document.createElement('div');

            node.className = 'property';
            title.className = 'type';
            value.className = 'value';
            copy.className = 'copy';

            title.textContent = info;
            value.setAttribute('type', 'text');

            copy.addEventListener('click', function() {
                value.select();
            });

            node.appendChild(title);
            node.appendChild(value);
            node.appendChild(copy);

            this.node = node;
            this.value = value;
            this.info = title;

            info_box.appendChild(node);
        };

        var init = function init() {

            info_box = getElemById('color-info');

            RGBA = new InfoProperty('RGBA');
            HSLA = new InfoProperty('HSLA');
            HEXA = new InfoProperty('HEXA');

            UIColorPicker.subscribe('picker', updateInfo);

        };

        return {
            init: init
        };

    })();

    /**
     * ColorPicker Samples
     */
    // var ColorPickerSamples = (function ColorPickerSamples() {
    //
    //     var samples = [];
    //     var nr_samples = 0;
    //     var active = null;
    //     var container = null;
    //     var	samples_per_line = 10;
    //     var trash_can = null;
    //     var base_color = new HSLColor(0, 50, 100);
    //     var add_btn;
    //     var add_btn_pos;
    //
    //     var ColorSample = function ColorSample() {
    //         var node = document.createElement('div');
    //         node.className = 'sample';
    //
    //         this.uid = samples.length;
    //         this.index = nr_samples++;
    //         this.node = node;
    //         this.color = new Color(base_color);
    //
    //         node.setAttribute('sample-id', this.uid);
    //         node.setAttribute('draggable', 'true');
    //
    //         node.addEventListener('dragstart', this.dragStart.bind(this));
    //         node.addEventListener('dragover' , allowDropEvent);
    //         node.addEventListener('drop'     , this.dragDrop.bind(this));
    //
    //         this.updatePosition(this.index);
    //         this.updateBgColor();
    //         samples.push(this);
    //     };
    //
    //     ColorSample.prototype.updateBgColor = function updateBgColor() {
    //         this.node.style.backgroundColor = this.color.getColor();
    //     };
    //
    //     ColorSample.prototype.updatePosition = function updatePosition(index) {
    //         this.index = index;
    //         this.posY = 5 + ((index / samples_per_line) | 0) * 52;
    //         this.posX = 5 + ((index % samples_per_line) | 0) * 52;
    //         this.node.style.top  = this.posY + 'px';
    //         this.node.style.left = this.posX + 'px';
    //     };
    //
    //     ColorSample.prototype.updateColor = function updateColor(color) {
    //         this.color.copy(color);
    //         this.updateBgColor();
    //     };
    //
    //     ColorSample.prototype.activate = function activate() {
    //         UIColorPicker.setColor('picker', this.color);
    //         this.node.setAttribute('data-active', 'true');
    //     };
    //
    //     ColorSample.prototype.deactivate = function deactivate() {
    //         this.node.removeAttribute('data-active');
    //     };
    //
    //     ColorSample.prototype.dragStart = function dragStart(e) {
    //         e.dataTransfer.setData('sampleID', this.uid);
    //         e.dataTransfer.setData('location', 'picker-samples');
    //     };
    //
    //     ColorSample.prototype.dragDrop = function dragDrop(e) {
    //         e.stopPropagation();
    //         this.color = Tool.getSampleColorFrom(e);
    //         this.updateBgColor();
    //     };
    //
    //     ColorSample.prototype.deleteSample = function deleteSample() {
    //         container.removeChild(this.node);
    //         samples[this.uid] = null;
    //         nr_samples--;
    //     };
    //
    //     var updateUI = function updateUI() {
    //         updateContainerProp();
    //
    //         var index = 0;
    //         var nr = samples.length;
    //         for (var i=0; i < nr; i++)
    //             if (samples[i] !== null) {
    //                 samples[i].updatePosition(index);
    //                 index++;
    //             }
    //
    //         AddSampleButton.updatePosition(index);
    //     };
    //
    //     var deleteSample = function deleteSample(e) {
    //         trash_can.parentElement.setAttribute('drag-state', 'none');
    //
    //         var location = e.dataTransfer.getData('location');
    //         if (location !== 'picker-samples')
    //             return;
    //
    //         var sampleID = e.dataTransfer.getData('sampleID');
    //         samples[sampleID].deleteSample();
    //         console.log(samples);
    //
    //         updateUI();
    //     };
    //
    //     var createDropSample = function createDropSample() {
    //         var sample = document.createElement('div');
    //         sample.id = 'drop-effect-sample';
    //         sample.className = 'sample';
    //         container.appendChild(sample);
    //     };
    //
    //     var setActivateSample = function setActivateSample(e) {
    //         if (e.target.className !== 'sample')
    //             return;
    //
    //         unsetActiveSample(active);
    //         Tool.unsetVoidSample();
    //         CanvasSamples.unsetActiveSample();
    //         active = samples[e.target.getAttribute('sample-id')];
    //         active.activate();
    //     };
    //
    //     var unsetActiveSample = function unsetActiveSample() {
    //         if (active)
    //             active.deactivate();
    //         active = null;
    //     };
    //
    //     var getSampleColor = function getSampleColor(id) {
    //         if (samples[id] !== undefined && samples[id]!== null)
    //             return new Color(samples[id].color);
    //     };
    //
    //     var updateContainerProp = function updateContainerProp() {
    //         samples_per_line = ((container.clientWidth - 5) / 52) | 0;
    //         var height = 52 * (1 + (nr_samples / samples_per_line) | 0);
    //         container.style.height = height + 10 + 'px';
    //     };
    //
    //     var AddSampleButton = (function AddSampleButton() {
    //         var node;
    //         var _index = 0;
    //         var _posX;
    //         var _posY;
    //
    //         var updatePosition = function updatePosition(index) {
    //             _index = index;
    //             _posY = 5 + ((index / samples_per_line) | 0) * 52;
    //             _posX = 5 + ((index % samples_per_line) | 0) * 52;
    //
    //             node.style.top  = _posY + 'px';
    //             node.style.left = _posX + 'px';
    //         };
    //
    //         var addButtonClick = function addButtonClick() {
    //             var sample = new ColorSample();
    //             container.appendChild(sample.node);
    //             updatePosition(_index + 1);
    //             updateUI();
    //         };
    //
    //         var init = function init() {
    //             node = document.createElement('div');
    //             var icon = document.createElement('div');
    //
    //             node.className = 'sample';
    //             icon.id = 'add-icon';
    //             node.appendChild(icon);
    //             node.addEventListener('click', addButtonClick);
    //
    //             updatePosition(0);
    //             container.appendChild(node);
    //         };
    //
    //         return {
    //             init : init,
    //             updatePosition : updatePosition
    //         };
    //     })();
    //
    //     var init = function init() {
    //         container = getElemById('picker-samples');
    //         trash_can = getElemById('trash-can');
    //
    //         AddSampleButton.init();
    //
    //         for (var i=0; i<16; i++) {
    //             var sample = new ColorSample();
    //             container.appendChild(sample.node);
    //         }
    //
    //         AddSampleButton.updatePosition(samples.length);
    //         updateUI();
    //
    //         active = samples[0];
    //         active.activate();
    //
    //         container.addEventListener('click', setActivateSample);
    //
    //         trash_can.addEventListener('dragover', allowDropEvent);
    //         trash_can.addEventListener('dragenter', function() {
    //             this.parentElement.setAttribute('drag-state', 'enter');
    //         });
    //         trash_can.addEventListener('dragleave', function(e) {
    //             this.parentElement.setAttribute('drag-state', 'none');
    //         });
    //         trash_can.addEventListener('drop', deleteSample);
    //
    //         UIColorPicker.subscribe('picker', function(color) {
    //             if (active)
    //                 active.updateColor(color);
    //         });
    //
    //     };
    //
    //     return {
    //         init : init,
    //         getSampleColor : getSampleColor,
    //         unsetActiveSample : unsetActiveSample
    //     };
    //
    // })();

    /**
     * Canvas Samples
     */
    // var CanvasSamples = (function CanvasSamples() {
    //
    //     var active = null;
    //     var canvas = null;
    //     var samples = [];
    //     var zindex = null;
    //     var tutorial = true;
    //
    //     var CanvasSample = function CanvasSample(color, posX, posY) {
    //
    //         var node = document.createElement('div');
    //         var pick = document.createElement('div');
    //         var delete_btn = document.createElement('div');
    //         node.className = 'sample';
    //         pick.className = 'pick';
    //         delete_btn.className = 'delete';
    //
    //         this.uid = samples.length;
    //         this.node = node;
    //         this.color = color;
    //         this.updateBgColor();
    //         this.zIndex = 1;
    //
    //         node.style.top = posY - 50 + 'px';
    //         node.style.left = posX - 50 + 'px';
    //         node.setAttribute('sample-id', this.uid);
    //
    //         node.appendChild(pick);
    //         node.appendChild(delete_btn);
    //
    //         var activate = function activate() {
    //             setActiveSample(this);
    //         }.bind(this);
    //
    //         node.addEventListener('dblclick', activate);
    //         pick.addEventListener('click', activate);
    //         delete_btn.addEventListener('click', this.deleteSample.bind(this));
    //
    //         UIComponent.makeDraggable(node);
    //         UIComponent.makeResizable(node);
    //
    //         samples.push(this);
    //         canvas.appendChild(node);
    //         return this;
    //     };
    //
    //     CanvasSample.prototype.updateBgColor = function updateBgColor() {
    //         this.node.style.backgroundColor = this.color.getColor();
    //     };
    //
    //     CanvasSample.prototype.updateColor = function updateColor(color) {
    //         this.color.copy(color);
    //         this.updateBgColor();
    //     };
    //
    //     CanvasSample.prototype.updateZIndex = function updateZIndex(value) {
    //         this.zIndex = value;
    //         this.node.style.zIndex = value;
    //     };
    //
    //     CanvasSample.prototype.activate = function activate() {
    //         this.node.setAttribute('data-active', 'true');
    //         zindex.setAttribute('data-active', 'true');
    //
    //         UIColorPicker.setColor('picker', this.color);
    //         InputSliderManager.setValue('z-index', this.zIndex);
    //     };
    //
    //     CanvasSample.prototype.deactivate = function deactivate() {
    //         this.node.removeAttribute('data-active');
    //         zindex.removeAttribute('data-active');
    //     };
    //
    //     CanvasSample.prototype.deleteSample = function deleteSample() {
    //         if (active === this)
    //             unsetActiveSample();
    //         canvas.removeChild(this.node);
    //         samples[this.uid] = null;
    //     };
    //
    //     CanvasSample.prototype.updatePosition = function updatePosition(posX, posY) {
    //         this.node.style.top = posY - this.startY + 'px';
    //         this.node.style.left = posX - this.startX + 'px';
    //     };
    //
    //     var canvasDropEvent = function canvasDropEvent(e) {
    //         var color = Tool.getSampleColorFrom(e);
    //
    //         if (color) {
    //             var offsetX = e.pageX - canvas.offsetLeft;
    //             var offsetY = e.pageY - canvas.offsetTop;
    //             var sample = new CanvasSample(color, offsetX, offsetY);
    //             if (tutorial) {
    //                 tutorial = false;
    //                 canvas.removeAttribute('data-tutorial');
    //                 var info = new CanvasSample(new Color(), 100, 100);
    //                 info.node.setAttribute('data-tutorial', 'dblclick');
    //             }
    //         }
    //
    //     };
    //
    //     var setActiveSample = function setActiveSample(sample) {
    //         ColorPickerSamples.unsetActiveSample();
    //         Tool.unsetVoidSample();
    //         unsetActiveSample();
    //         active = sample;
    //         active.activate();
    //     };
    //
    //     var unsetActiveSample = function unsetActiveSample() {
    //         if (active)
    //             active.deactivate();
    //         active = null;
    //     };
    //
    //     var createToggleBgButton = function createToggleBgButton() {
    //         var button = document.createElement('div');
    //         var state = false;
    //         button.className = 'toggle-bg';
    //         canvas.appendChild(button);
    //
    //         button.addEventListener('click', function() {
    //             console.log(state);
    //             state = !state;
    //             canvas.setAttribute('data-bg', state);
    //         });
    //     };
    //
    //     var init = function init() {
    //         canvas = getElemById('canvas');
    //         zindex = getElemById('zindex');
    //
    //         canvas.addEventListener('dragover', allowDropEvent);
    //         canvas.addEventListener('drop', canvasDropEvent);
    //
    //         createToggleBgButton();
    //
    //         UIColorPicker.subscribe('picker', function(color) {
    //             if (active)	active.updateColor(color);
    //         });
    //
    //         InputSliderManager.subscribe('z-index', function (value) {
    //             if (active)	active.updateZIndex(value);
    //         });
    //
    //         UIComponent.makeResizable(canvas, 'height');
    //     };
    //
    //     return {
    //         init : init,
    //         unsetActiveSample : unsetActiveSample
    //     };
    //
    // })();

    var StateButton = function StateButton(node, state) {
        this.state = false;
        this.callback = null;

        node.addEventListener('click', function() {
            this.state = !this.state;
            if (typeof this.callback === "function")
                this.callback(this.state);
        }.bind(this));
    };

    StateButton.prototype.set = function set() {
        this.state = true;
        if (typeof this.callback === "function")
            this.callback(this.state);
    };

    StateButton.prototype.unset = function unset() {
        this.state = false;
        if (typeof this.callback === "function")
            this.callback(this.state);
    };

    StateButton.prototype.subscribe = function subscribe(func) {
        this.callback = func;
    };

    /**
     * Tool
     */
    // var Tool = (function Tool() {
    //
    //     var samples = [];
    //     var controls = null;
    //     var void_sw;
    //
    //     var createPickerModeSwitch = function createPickerModeSwitch() {
    //         var parent = getElemById('controls');
    //         var icon = document.createElement('div');
    //         var button = document.createElement('div');
    //         var hsv = document.createElement('div');
    //         var hsl = document.createElement('div');
    //         var active = null;
    //
    //         icon.className = 'icon picker-icon';
    //         button.className = 'switch';
    //         button.appendChild(hsv);
    //         button.appendChild(hsl);
    //
    //         hsv.textContent = 'HSV';
    //         hsl.textContent = 'HSL';
    //
    //         active = hsl;
    //         active.setAttribute('data-active', 'true');
    //
    //         function switchPickingModeTo(elem) {
    //             active.removeAttribute('data-active');
    //             active = elem;
    //             active.setAttribute('data-active', 'true');
    //             UIColorPicker.setPickerMode('picker', active.textContent);
    //         };
    //
    //         var picker_sw = new StateButton(icon);
    //         picker_sw.subscribe(function() {
    //             if (active === hsv)
    //                 switchPickingModeTo(hsl);
    //             else
    //                 switchPickingModeTo(hsv);
    //         });
    //
    //         hsv.addEventListener('click', function() {
    //             switchPickingModeTo(hsv);
    //         });
    //         hsl.addEventListener('click', function() {
    //             switchPickingModeTo(hsl);
    //         });
    //
    //         parent.appendChild(icon);
    //         parent.appendChild(button);
    //     };
    //
    //     var setPickerDragAndDrop = function setPickerDragAndDrop() {
    //         var preview = document.querySelector('#picker .preview-color');
    //         var pickingArea = document.querySelector('#picker .picking-area');
    //
    //         preview.setAttribute('draggable', 'true');
    //         preview.addEventListener('drop', drop);
    //         preview.addEventListener('dragstart', dragStart);
    //         preview.addEventListener('dragover', allowDropEvent);
    //
    //         pickingArea.addEventListener('drop', drop);
    //         pickingArea.addEventListener('dragover', allowDropEvent);
    //
    //         function drop(e) {
    //             var color = getSampleColorFrom(e);
    //             UIColorPicker.setColor('picker', color);
    //         };
    //
    //         function dragStart(e) {
    //             e.dataTransfer.setData('sampleID', 'picker');
    //             e.dataTransfer.setData('location', 'picker');
    //         };
    //     };
    //
    //     var getSampleColorFrom = function getSampleColorFrom(e) {
    //         var sampleID = e.dataTransfer.getData('sampleID');
    //         var location = e.dataTransfer.getData('location');
    //
    //         if (location === 'picker')
    //             return UIColorPicker.getColor(sampleID);
    //         if (location === 'picker-samples')
    //             return ColorPickerSamples.getSampleColor(sampleID);
    //         if (location === 'palette-samples')
    //             return ColorPalette.getSampleColor(sampleID);
    //     };
    //
    //     var setVoidSwitch = function setVoidSwitch() {
    //         var void_sample = getElemById('void-sample');
    //         void_sw = new StateButton(void_sample);
    //         void_sw.subscribe( function (state) {
    //             void_sample.setAttribute('data-active', state);
    //             if (state === true) {
    //                 ColorPickerSamples.unsetActiveSample();
    //                 CanvasSamples.unsetActiveSample();
    //             }
    //         });
    //     };
    //
    //     var unsetVoidSample = function unsetVoidSample() {
    //         void_sw.unset();
    //     };
    //
    //     var init = function init() {
    //         controls = getElemById('controls');
    //
    //         var color = new Color();
    //         color.setHSL(0, 51, 51);
    //         UIColorPicker.setColor('picker', color);
    //
    //         setPickerDragAndDrop();
    //         createPickerModeSwitch();
    //         setVoidSwitch();
    //     };
    //
    //     return {
    //         init : init,
    //         unsetVoidSample : unsetVoidSample,
    //         getSampleColorFrom : getSampleColorFrom
    //     };
    //
    // })();

    var init = function init() {
        UIColorPicker.init();
        InputSliderManager.init();
        ColorInfo.init();
        ColorPalette.init();
        // ColorPickerSamples.init();
        // CanvasSamples.init();
        // Tool.init();
    };

    return {
        init : init
    };

})();
