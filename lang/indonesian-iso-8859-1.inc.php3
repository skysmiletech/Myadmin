<?php
/* $Id$ */

$charset = 'iso-8859-1';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
$month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d. %B %Y jam %H:%M';
$timespanfmt = '%s hari, %s jam, %s menit dan %s detik';

$strAPrimaryKey = 'Primary key telah ditambah pada %s';
$strAbortedClients = 'Dibatalkan';
$strAbsolutePathToDocSqlDir = 'Silakan isi Absolute Path di webserver yang menunjuk ke direktori docSQL';
$strAccessDenied = 'Akses ditolak';
$strAction = 'Aksi';
$strAddDeleteColumn = 'Tambah/Hapus kolom';
$strAddDeleteRow = 'Tambah/Hapus baris';
$strAddNewField = 'Tambah field baru';
$strAddPriv = 'Tambah hak (privilege) baru';
$strAddPrivMessage = 'Hak (privilege) baru telah ditambah.';
$strAddPrivilegesOnDb = 'Tambah hak (privileges) pada database berikut';
$strAddPrivilegesOnTbl = 'Tambah hak (privileges) pada tabel berikut';
$strAddSearchConditions = 'Tambah kriteria pencarian (Argumen untuk WHERE-Statement):';
$strAddToIndex = 'Tambah ke indeks &nbsp;%s&nbsp;kolom';
$strAddUser = 'Tambah pengguna baru';
$strAddUserMessage = 'Pengguna baru telah ditambah.';
$strAddedColumnComment = 'Komentar untuk kolum telah ditambahkan';
$strAddedColumnRelation = 'Relasi untuk kolum telah ditambahkan';
$strAdministration = 'Administrasi';
$strAffectedRows = 'Baris yang terlibat:';
$strAfter = 'Sisipkan setelah %s';
$strAfterInsertBack = 'Kembali';
$strAfterInsertNewInsert = 'Sisipkan baris yang baru';
$strAll = 'Semua';
$strAllTableSameWidth = 'Tampilkan semua tabel dengan kelebaran yang sama?';
$strAlterOrderBy = 'Urutkan tabel berdasarkan';
$strAnIndex = 'Indeks telah ditambah pada %s';
$strAnalyzeTable = 'Analisa tabel';
$strAnd = 'dan';
$strAny = 'Setiap';
$strAnyColumn = 'Setiap kolom';
$strAnyDatabase = 'Setiap database';
$strAnyHost = 'Setiap host';
$strAnyTable = 'Setiap tabel';
$strAnyUser = 'Setiap penguna';
$strAscending = 'Urutan menaik';
$strAtBeginningOfTable = 'pada awal tabel';
$strAtEndOfTable = 'pada akhir tabel';
$strAttr = 'Atribut';

$strBack = 'Kembali';
$strBeginCut = 'Mulai potong (CUT)';
$strBeginRaw = 'MULAI mentah (RAW)';
$strBinary = 'Binari';
$strBinaryDoNotEdit = 'Binari - jangan di-edit';
$strBookmarkDeleted = 'Bookmark telah dihapus.';
$strBookmarkLabel = 'Judul';
$strBookmarkQuery = 'Bookmark query SQL ';
$strBookmarkThis = 'Bookmark SQL-query ini';
$strBookmarkView = 'Hanya melihat';
$strBrowse = 'Browse';
$strBzError = 'phpMyAdmin gagal menkompres Dump (Skema) disebabkan oleh ekstensi Bz2 dalam versi PHP yang digunakan. Disarankan untuk merubah direktif <code>$cfg[\'BZipDump\']</code> dalam file konfigurasi phpMyAdmin Anda ke <code>FALSE</code>. Bila Anda ingin mengunakan fasilitas kompresi Bz2 disarankan untuk meng-upgrade versi PHP yang lebih tinggi. Perhatikan PHP Bug Report %s untuk informasi yang lebih detail.';
$strBzip = '"Dikompress dengan BZip"';

$strCannotLogin = 'Gagal login ke MySQL server';
$strCantLoadMySQL = 'Gagal loading extensi MySQL,<br />mohon periksa kembali konfigurasi PHP.';
$strCantLoadRecodeIconv = 'Gagal loading iconv atau perubahan kode extension untuk konversi charset diperlukan. Silakan konfigurasikan php untuk mengunakan extensions yang diperlukan atau matikan fasilitas charset conversion di phpMyAdmin.';
$strCantRenameIdxToPrimary = 'Gagal ubah nama Indeks ke PRIMARY!';
$strCantUseRecodeIconv = 'Gagal mengunakan iconv, libiconv atau fungsi recode_string apabila extension masih dalam keadaan di-load. Periksa kembali konfigurasi php.';
$strCardinality = 'Huruf besar atau kecil';
$strCarriage = 'Di baris baru: \\r';
$strChange = 'Ubah';
$strChangeDisplay = 'Pilih Field untuk ditampilkan';
$strChangePassword = 'Ubah Kata Sandi';
$strCharsetOfFile = 'Kumpulan karakter (Character set) dari file:';
$strCheckAll = 'Tanda semua';
$strCheckDbPriv = 'Periksa Hak Akses dari Database';
$strCheckTable = 'Periksa tabel';
$strChoosePage = 'Silakan pilih halaman untuk diubah';
$strColComFeat = 'Tampilkan komentar kolom';
$strColumn = 'Kolom';
$strColumnNames = 'Nama kolom';
$strColumnPrivileges = 'Hak (privileges) khusus terhadap kolum';
$strCommand = 'Perintah';
$strComments = 'Komentar';
$strCompleteInserts = 'Penyisipan lengkap';
$strCompression = 'Kompresi';
$strConfigFileError = 'phpMyAdmin gagal membaca file konfigurasi!<br />Hal ini diakibatkan oleh parse error atau file tidak ditemukan.<br />Silakan buka file konfigurasi secara langsung dengan gunakan link dibawah. Mohon perhatikan php error message(s) yang akan tertampil. Serinkali sebuah quote atau semicolon tertinggal.<br />Jika sebuah halaman kosong yang muncul berarti tidak ada masalah.';
$strConfigureTableCoord = 'Silakan konfigurasikan koordinasi bagi tabel %s';
$strConfirm = 'Anda yakin ingin melakukannya?';
$strConnections = 'Koneksi';
$strCookiesRequired = 'Cookies harus diaktifkan mulai dari sini.';
$strCopyTable = 'Salin tabel ke (database<b>.</b>nama tabel):';
$strCopyTableOK = 'Tabel %s telah disalin ke %s.';
$strCouldNotKill = 'phpMyAdmin gagal menutup Thread %s. Kemungkinan Thread tersebut sudah ditutup';
$strCreate = 'Buat';
$strCreateIndex = 'Buat indeks pada kolom &nbsp;%s&nbsp;';
$strCreateIndexTopic = 'Buat indeks baru';
$strCreateNewDatabase = 'Buat database baru';
$strCreateNewTable = 'Buat tabel baru pada database %s';
$strCreatePage = 'Buat halaman baru';
$strCreatePdfFeat = 'Pembuatan PDF';
$strCriteria = 'Kriteria';

$strData = 'Data';
$strDataDict = 'Kamus Data';
$strDataOnly = 'Data saja';
$strDatabase = 'Database ';
$strDatabaseHasBeenDropped = 'Database %s telah dihapus.';
$strDatabaseWildcard = 'Database (wildcards diizinkan):';
$strDatabases = 'database';
$strDatabasesStats = 'Statistik Database';
$strDbPrivileges = 'Hak (privileges) khusus terhadap Database';
$strDefault = 'Default';
$strDelete = 'Hapus';
$strDeleteAndFlush = 'Hapus Pengguna dan Reload Hak Istimewa (Privileges).';
$strDeleteAndFlushDescr = 'Ini cara terbaik tetapi akan memakan waktu.';
$strDeleteFailed = 'Penghapusan gagal!';
$strDeleteUserMessage = 'Penguna %s telah dihapus.';
$strDeleted = 'Baris telah dihapus';
$strDeletedRows = 'Baris yang dihapus:';
$strDeleting = 'Menghapus %s';
$strDescending = 'Menurun';
$strDisabled = 'Tidak aktif';
$strDisplay = 'Tampilkan';
$strDisplayFeat = 'Tampilkan ciri-ciri';
$strDisplayOrder = 'Urutan tampilan berdasarkan:';
$strDisplayPDF = 'Tampilkan skema PDF';
$strDoAQuery = 'Cari berdasarkan data contoh ("query by example") (wildcard: "%")';
$strDoYouReally = 'Apakah anda ingin ';
$strDocu = 'Dokumentasi';
$strDrop = 'Hapus Field ini';
$strDropDB = 'Hapus database %s';
$strDropTable = 'Hapus tabel:';
$strDropUsersDb = 'Hapus database yang miliki nama yang sama dengan pengunanya.';
$strDumpXRows = 'Dump %s baris bermula pada baris %s.';
$strDumpingData = 'Dumping data untuk tabel';
$strDynamic = 'dinamis';

$strEdit = 'Ubah';
$strEditPDFPages = 'Ubah halaman PDF';
$strEditPrivileges = 'Ubah hak akses (privilege)';
$strEffective = 'Efektif';
$strEmpty = 'Hapus semua Record';
$strEmptyResultSet = 'MySQL balikkan hasil kosong (a.k. baris yang kosong).';
$strEnabled = 'Aktif';
$strEnd = 'Terakhir';
$strEndCut = 'Akhiri potong (CUT)';
$strEndRaw = 'AKHIRI mentah (RAW)';
$strEnglishPrivileges = ' Catatan: Nama privilege MySQL adalah dalam bahasa Ingris ';
$strError = 'Error';
$strExplain = 'Terangkan SQL';
$strExport = 'Ekspor';
$strExportToXML = 'Ekspor ke format XML';
$strExtendedInserts = 'Penyisipan diperluas';
$strExtra = 'Ekstra';

$strFailedAttempts = 'Percobaan yang telah gagal';
$strField = 'Field';
$strFieldHasBeenDropped = 'Field %s telah dihapus';
$strFields = 'Field';
$strFieldsEmpty = ' Jumlah field dalam tabel harus ditentukan! ';
$strFieldsEnclosedBy = 'Field ditutup dengan';
$strFieldsEscapedBy = 'Field dikembalikan oleh';
$strFieldsTerminatedBy = 'Fields diputus oleh';
$strFileCouldNotBeRead = 'File tidak bisa dibaca';
$strFixed = 'telah diperbaiki';
$strFlushPrivilegesNote = 'Perhatian: phpMyAdmin mengambil data hak dari Penguna secara langsung dari tabel Hak Istimewa (Privileges) MySQL. Isi dari tabel tersebut bisa berbeda dari Hak Istimewa (Privileges) yang digunakan oleh Server bila pernah diubah. Bila begitu disarankan untuk %sReload Hak Istimewa (Privileges)%s sebelum melanjut.';
$strFlushTable = 'Tutup tabel ("FLUSH")';
$strFormEmpty = 'Kurang data dalam form !';
$strFormat = 'Format';
$strFullText = 'Teks Penuh';
$strFunction = 'Fungsi';

$strGenBy = 'Diadakan oleh';
$strGenTime = 'Waktu pembuatan';
$strGeneralRelationFeat = 'Ciri-ciri dari General Relation';
$strGlobalPrivileges = 'Hak Istimewa (Privileges) Global';
$strGlobalValue = 'Nilai Global';
$strGo = 'Go';
$strGrantOption = 'Mengizinkan';
$strGrants = 'Hak (Grants)';
$strGzip = '"Dikompress dengan GZip"';

$strHasBeenAltered = 'telah diubah.';
$strHasBeenCreated = 'telah diciptakan.';
$strHaveToShow = 'Sekurang-kurangnya satu kolom harus dipilih untuk ditampilkan';
$strHome = 'Home';
$strHomepageOfficial = 'Homepage resmi phpMyAdmin';
$strHomepageSourceforge = 'Halaman download phpMyAdmin di Sourceforge';
$strHost = 'Host';
$strHostEmpty = 'Nama Host harus diisi!';

$strId = 'ID';
$strIdxFulltext = 'Teks penuh';
$strIfYouWish = 'Jika Anda hanya ingin memuat beberapa kolom dari tabel, gunakan tanda koma sebagai pemisah.';
$strIgnore = 'Abaikan';
$strIgnoringFile = 'Abaikan file %s';
$strImportDocSQL = 'Impor file docSQL';
$strImportFiles = 'Impor file';
$strImportFinished = 'Impor selesai';
$strInUse = 'sedang digunakan';
$strIndex = 'Indeks';
$strIndexHasBeenDropped = 'Indeks %s telah dihapus';
$strIndexName = 'Nama indeks&nbsp;:';
$strIndexType = 'Tipe indeks&nbsp;:';
$strIndexes = 'Indeks';
$strInsecureMySQL = 'File konfigurasi Anda diset dengan pengguna Root dan tanpa adanya Kata Sandi sama dengan Default MySQL Privileged Account. Jika MySQL-Server Anda dijalankan dengan sedemikian, server Anda terbuka untuk penyerangan. Disarankan untuk memperbaiki kelemahan keamanan (security hole) ini.';
$strInsert = 'Sisipkan';
$strInsertAsNewRow = 'Sisipkan sebagai baris baru';
$strInsertNewRow = 'Sisipkan baris baru';
$strInsertTextfiles = 'Sisipkan data baru dari textfile ke dalam tabel';
$strInsertedRows = 'Baris yang disisipkan:';
$strInstructions = 'Petunjuk';
$strInvalidName = '"%s" adalah kata khusus dan tidak dapat dipergunakan sebagai nama database,tabel atau field.';

$strJustDelete = 'Tinggal hapuskan penguna dari tabel Hak Istimewa (Privileges).';
$strJustDeleteDescr = 'Penguna yang &quot;dihapus&quot; tetap berhak untuk mengakses Server seperti biasa sampai Hak Istimewa (Privileges) di-reload.';

$strKeepPass = 'Kata Sandi jangan dirubah';
$strKeyname = 'Keyname';
$strKill = 'Tutup';

$strLaTeX = 'LaTeX';
$strLandscape = 'Landscape';
$strLength = 'Ukuran Panjang';
$strLengthSet = 'Ukuran Panjang/Nilai*';
$strLimitNumRows = 'Jumlah baris per halaman';
$strLineFeed = 'Linefeed: \\n';
$strLines = 'Garis';
$strLinesTerminatedBy = 'Garis diputuskan oleh';
$strLinkNotFound = 'Link tidak ditemukan';
$strLinksTo = 'Link ke';
$strLocalhost = 'Lokal';
$strLocationTextfile = 'Lokasi dari textfile';
$strLogPassword = 'Kata Sandi:';
$strLogUsername = 'Nama Pengguna:';
$strLogin = 'Login';
$strLoginInformation = 'Informasi Login';
$strLogout = 'Logout';

$strMissingBracket = 'Kekurangan tanda kurung';
$strModifications = 'Modifikasi telah disimpan';
$strModify = 'Ubah';
$strModifyIndexTopic = 'Ubah indeks';
$strMoreStatusVars = 'Variabel tentang status lebih lengkap';
$strMoveTable = 'Pindahkan tabel ke (database<b>.</b>tabel):';
$strMoveTableOK = 'Tabel %s telah dipindahkan ke %s.';
$strMySQLCharset = 'Charset MySQL';
$strMySQLReloaded = 'MySQL telah di-reload.';
$strMySQLSaid = 'MySQL menyatakan: ';
$strMySQLServerProcess = 'MySQL %pma_s1% di %pma_s2% sebagai %pma_s3%';
$strMySQLShowProcess = 'Tampilkan Proses';
$strMySQLShowStatus = 'Tampilkan informasi runtime dari MySQL';
$strMySQLShowVars = 'Tampilkan variabel sistem dari MySQL';

$strName = 'Nama';
$strNext = 'Berikutnya';
$strNo = 'Tidak';
$strNoDatabases = 'Database tidak ditemukan';
$strNoDescription = 'tanpa keterangan';
$strNoDropDatabases = 'Perintah "DROP DATABASE" dimatikan.';
$strNoExplain = 'Melewati keterangan SQL';
$strNoFrames = 'Lebih mudah jika menggunakan phpMyAdmin dengan browser yang <b>mendukung frame</b>.';
$strNoIndex = 'Indeks tidak ditentukan!';
$strNoIndexPartsDefined = 'Tidak ada bagian indeks yang didefinisikan!';
$strNoModification = 'Tidak ada perubahan';
$strNoPassword = 'Tidak ada Kata Sandi';
$strNoPhp = 'tidak ada kode PHP';
$strNoPrivileges = 'Tidak ada Hak Akses (privilege)';
$strNoQuery = 'Tidak ada query SQL!';
$strNoRights = 'Hak Akses Anda untuk melanjut tidak cukup!';
$strNoTablesFound = 'Tidak ada tabel dalam database.';
$strNoUsersFound = 'Pengguna tidak ditemukan.';
$strNoUsersSelected = 'Tidak ada penguna yang dipilih.';
$strNoValidateSQL = 'Melewati pengesahan (validation) SQL';
$strNone = 'tanpa';
$strNotNumber = 'Ini adalah bukan angka!';
$strNotOK = 'tidak oke';
$strNotSet = '<b>%s</b> tabel tidak ditemukan atau tidak diset di %s';
$strNotValidNumber = ' bukan nomor baris yang berlaku!';
$strNull = 'Kosong';
$strNumSearchResultsInTable = '%s Rekord dalam tabel <i>%s</i>';
$strNumSearchResultsTotal = '<b>Jumlah:</b> <i>%s</i> rekord';
$strNumTables = 'Tabel';

$strOK = 'Oke';
$strOftenQuotation = 'Terlalu banyak tanda kutip. PILIHAN berarti hanya field dengan tipe char dan varchar yang ditutup oleh karakter "ditutup oleh" tersebut.';
$strOperations = 'Operasi';
$strOptimizeTable = 'Optimasikan tabel';
$strOptionalControls = 'Pilihan. Mengontrol cara menulis dan membaca karakter khusus.';
$strOptionally = 'PILIHAN';
$strOptions = 'Setingan';
$strOr = 'Atau';
$strOverhead = 'Kelebihan (Overhead)';

$strPHP40203 = 'Anda memakai versi PHP 4.2.3 yang diketahui mengandung Bug yang serius dengan multi-byte strings (mbstring). Perhatikan PHP Bug Report 19404. Versi PHP ini tidak disarankan untuk dipakai dengan program phpMyAdmin.';
$strPHPVersion = 'Versi PHP';
$strPageNumber = 'Halaman no.:';
$strPartialText = 'Teks yang disingkat';
$strPassword = 'Kata Sandi';
$strPasswordChanged = 'Sukses mengubah Kata Sandi untuk %s .';
$strPasswordEmpty = 'Kata Sandi kosong!';
$strPasswordNotSame = 'Kata Sandi tidak sama!';
$strPdfDbSchema = 'Skema dari database "%s"  - Halaman %s';
$strPdfInvalidPageNum = 'Nomor halaman PDF tidak ditentukan!';
$strPdfInvalidTblName = 'Tabel "%s" tidak ditemukan!';
$strPdfNoTables = 'Tabel tidak ditemukan';
$strPerHour = 'dalam sejam';
$strPhp = 'Ciptakan kode PHP';
$strPmaDocumentation = 'Dokumentasi phpMyAdmin';
$strPmaUriError = 'Directif <tt>$cfg[\'PmaAbsoluteUri\']</tt> WAJIB diset dalam file konfigurasi!';
$strPortrait = 'Gambaran';
$strPos1 = 'Awal';
$strPrevious = 'Sebelumnya';
$strPrimary = 'PRIMARY';
$strPrimaryKey = 'Primary key';
$strPrimaryKeyHasBeenDropped = 'Primary key telah dihapus';
$strPrimaryKeyName = 'Nama primary key mesti... PRIMARY!';
$strPrimaryKeyWarning = '(Tanda nama "PRIMARY" <b>wajib</b> sebagai satu-satunya nama dan <b>hanya</b> sebagai Primary Key saja!)';
$strPrint = 'Cetak';
$strPrintView = 'Pandangan cetak';
$strPrivDescAllPrivileges = 'Mengunakan seluruh Hak Istimewa (Privileges) selain GRANT.';
$strPrivDescAlter = 'Mengizinkan untuk merubah struktur dari tabel yang ada.';
$strPrivDescCreateDb = 'Mengizinkan untuk buat Database dan tabel yang baru.';
$strPrivDescCreateTbl = 'Mengizinkan untuk buat tabel baru.';
$strPrivDescCreateTmpTable = 'Mengizinkan untuk buat tabel yang bersifat temporer.';
$strPrivDescDelete = 'Mengizinkan untuk hapus data.';
$strPrivDescDropDb = 'Mengizinkan untuk drop Database dan tabel.';
$strPrivDescDropTbl = 'Mengizinkan untuk drop tabel.';
$strPrivDescExecute = 'Mengizinkan untuk berjalan dengan prosedur yang tersimpan; tidak ada efek dalam versi MySQL ini.';
$strPrivDescFile = 'Mengizinkan untuk impor data dari file dan ekspor data kedalam file.';
$strPrivDescGrant = 'Mengizinkan untuk tambah penguna dan Hak Istimewa (Privileges) tampah harus me-reload tabel Hak Istimewa tersebut.';
$strPrivDescIndex = 'Mengizinkan untuk buat dan hapus Indeks.';
$strPrivDescInsert = 'Mengizinkan untuk nambah dan ganti data.';
$strPrivDescLockTables = 'Mengizinkan untuk kunci tabel dalam Thread yang berjalan.';
$strPrivDescMaxConnections = 'Membatasi jumlah koneksi baru yang diperbolehkan untuk setiap penguna dalam batas waktu satu jam.';
$strPrivDescMaxQuestions = 'Membatasi jumlah pencarian (Queries) yang diperbolehkan untuk setiap penguna dalam batas waktu satu jam.';
$strPrivDescMaxUpdates = 'Membatasi jumlah perintah untuk ubah sebuah tabel atau database untuk setiap penguna dalam batas waktu satu jam.';
$strPrivDescProcess3 = 'Mengizinkan untuk hentikan proses yang dimiliki penguna lain.';
$strPrivDescProcess4 = 'Mengizinkan untuk tampilkan seluruh pencarian dalam daftar proses.';
$strPrivDescReferences = 'Tidak ada efek dalam versi MySQL yang digunakan.';
$strPrivDescReload = 'Mengizinkan untuk reload settingan dari server dan flush cache dari server.';
$strPrivDescReplClient = 'Memberi hak kepada penguna untuk menanya lokasi dari slaves / masters.';
$strPrivDescReplSlave = 'Digunakan untuk replikasi dari slaves.';
$strPrivDescSelect = 'Mengizinkan untuk baca data.';
$strPrivDescShowDb = 'Memberi akses ke seluruh daftar dari database.';
$strPrivDescShutdown = 'Mengizinkan untuk shut-down server.';
$strPrivDescSuper = 'Mengizinkan untuk tetap konek meskipun jumlah batas koneksi telah tercapai; diperlukan untuk hampir semua operasi administratif seperti setingan variabel global atau untuk mematikan sebuah Thread dari penguna lain.';
$strPrivDescUpdate = 'Mengizinkan untuk ubah data.';
$strPrivDescUsage = 'Tanpa Hak Istimewa (Privileges).';
$strPrivileges = 'Hak Akses (Privilege)';
$strPrivilegesReloaded = 'Sukses reload Hak Istimewa (Privileges).';
$strProcesslist = 'Daftar proses';
$strProperties = 'Properties';
$strPutColNames = 'Letakkan nama Fields pada baris pertama';

$strQBE = 'Cari berdasarkan data contoh';
$strQBEDel = 'Hapus';
$strQBEIns = 'Sisipkan';
$strQueryOnDb = 'Query SQL dalam database <b>%s</b>:';
$strQueryStatistics = '<b>Query statistics</b>: Since its startup, %s queries have been sent to the server.';
$strQueryType = 'Tipe Pencarian';

$strReType = 'Ketik ulang';
$strReceived = 'Diterima';
$strRecords = 'Rekord';
$strReferentialIntegrity = 'Cek integriti referensial:';
$strRelationNotWorking = 'Fasilitas tambahan untuk bekerja dengan tabel yang di-link di nonaktifkan. Untuk mengetahui soal klik %sdisini%s.';
$strRelationView = 'Tampilan relasi';
$strRelationalSchema = 'Skema Relational';
$strReloadFailed = 'MySQL gagal di-reload.';
$strReloadMySQL = 'Reload MySQL';
$strReloadingThePrivileges = 'Reload Hak Istimewa (Privileges)';
$strRememberReload = 'Ingatlah me-reload server.';
$strRemoveSelectedUsers = 'Hapus penguna yang dipilih';
$strRenameTable = 'Ubah nama tabel menjadi ';
$strRenameTableOK = 'Nama tabel %s telah diubah menjadi %s';
$strRepairTable = 'Perbaiki tabel';
$strReplace = 'Ganti';
$strReplaceTable = 'Ganti data tabel dengan file';
$strReset = 'Reset';
$strResourceLimits = 'Resource limits';
$strRevoke = 'Cabut';
$strRevokeAndDelete = 'Hapus penguna setelah cabut seluruh Hak Istimewa (Privileges) yang aktif dari penguna tersebut.';
$strRevokeAndDeleteDescr = 'Penguna yang bersangkutan tetap memiliki hak untuk USAGE sampai seluruh Hak Istimewa (Privileges) di-reload kembali.';
$strRevokeGrant = 'Cabut hak akses berstatus Grant';
$strRevokeGrantMessage = 'Hak akses berstatus Grant untuk %s telah dicabut';
$strRevokeMessage = 'Hak akses untuk %s telah dicabut';
$strRevokePriv = 'Cabut hak akses (privilege)';
$strRowLength = 'Ukuran panjang baris';
$strRowSize = ' Ukuran baris ';
$strRows = 'Baris';
$strRowsFrom = 'baris dimulai dari rekord #';
$strRowsModeHorizontal = 'horisontal';
$strRowsModeOptions = 'diatur dengan urutan %s dan ulang header setelah %s sel.';
$strRowsModeVertical = 'vertikal';
$strRowsStatistic = 'Statistik Baris';
$strRunQuery = 'Jalankan query SQL';
$strRunSQLQuery = 'Jalankan query SQL pada database %s';
$strRunning = 'dilaksana pada %s';

$strSQL = 'SQL';
$strSQLParserBugMessage = 'Kemungkinan Anda telah temukan sebuah Bug dalam parser SQL. Mohon periksa ulang Query SQL dengan teliti dan perhatikan apakah semua tanda kutip benar dan seimbang. Penyebab kegagalan bisa terjadi bila Anda meng-upload sebuah file binari diluar teks kutipan. Silakan Anda menjalankan Query tersebut dengan mengunakan command line interface. Hasil dari MySQL server error, jika tertampil, akan menolong Anda untuk mengetahui penyebab dari problem. Bila problem tersebut tetap muncul atau Parser dari kami masih juga gagal tetapi command line interface berhasil mohon kurangi input pada SQL query sampai Query yang bermasalah ditemukan. Mohon kirimkan sebuah Bug Report dengan sisipan data dalam bagian Potong (CUT) yang dibawah ini kepada kami:';
$strSQLParserUserError = 'Rupanya ada Error pada Query SQL. Hasil dari MySQL server error dibawa ini, jika tertampil, akan menolong Anda untuk mengetahui penyebab dari problem tersebut.';
$strSQLQuery = 'Query SQL';
$strSQLResult = 'Hasil SQL';
$strSQPBugInvalidIdentifer = 'Identifer tidak valid';
$strSQPBugUnclosedQuote = 'Kutipan tidak ditutup';
$strSQPBugUnknownPunctuation = 'Punctation String tidak dikenali';
$strSave = 'Simpan';
$strScaleFactorSmall = 'Faktor skala yang dipilih terlalu kecil untuk dimuat dalam skema satu halaman';
$strSearch = 'Cari';
$strSearchFormTitle = 'Cari dalam database';
$strSearchInTables = 'Cari dalam tabel:';
$strSearchNeedle = 'Kata atau nilai untuk dicari (wildcard: "%"):';
$strSearchOption1 = 'sekurang-kurangnya salah satu kata';
$strSearchOption2 = 'seluruh kata';
$strSearchOption3 = 'kata-kata tepat';
$strSearchOption4 = 'sebagai regular expression';
$strSearchResultsFor = 'Hasil pencarian untuk "<i>%s</i>" %s:';
$strSearchType = 'Cari:';
$strSelect = 'Pilih';
$strSelectADb = 'Silakan pilih database';
$strSelectAll = 'Pilih semua';
$strSelectFields = 'Pilih fields (minimal satu):';
$strSelectNumRows = 'dalam susunan pemeriksaan';
$strSelectTables = 'Pilih tabel';
$strSend = 'Kirim ke';
$strSent = 'Dikirim';
$strServer = 'Server %s';
$strServerChoice = 'Pilihan Server';
$strServerStatus = 'Informasi Runtime';
$strServerStatusUptime = 'MySQL server ini sudah berjalan secara berturut selama %s. Server dijalankan pada %s.';
$strServerTabProcesslist = 'Proses-Proses';
$strServerTabVariables = 'Variabel';
$strServerTrafficNotes = '<b>Server traffic</b>: These tables show the network traffic statistics of this MySQL server since its startup.';
$strServerVars = 'Variabel dan setingan dari server';
$strServerVersion = 'Versi Server';
$strSessionValue = 'Nilai dari Session';
$strSetEnumVal = 'Jika tipe field sama dengan "enum" atau "set", silakan masukkan nilai dengan format: \'a\',\'b\',\'c\'...<br />Jika sebuah backslash ("\") atau satu tanda kutip ("\'") diperlukan, tanda tersebut perlu ditutupi dengan tanda backslash (seb. contoh \'\\\\xyz\' atau \'a\\\'b\').';
$strShow = 'Tampilkan';
$strShowAll = 'Tampilkan semua';
$strShowColor = 'Tampilkan warna';
$strShowCols = 'Tampilkan kolom';
$strShowDatadictAs = 'Format dari Data Dictionary';
$strShowGrid = 'Tampilkan garis';
$strShowPHPInfo = 'Tampilkan informasi tentang PHP';
$strShowTableDimension = 'Tampilkan ukuran dari tabel';
$strShowTables = 'Tampilkan tabel';
$strShowThisQuery = ' Tampilkan ulang query SQL ';
$strShowingRecords = 'Tampilan baris';
$strSingly = '(unik)';
$strSize = 'Ukuran';
$strSort = 'Urutkan';
$strSpaceUsage = 'Penggunaan ruang';
$strSplitWordsWithSpace = 'Kata dipisahkan oleh karakter spasi (" ").';
$strStatement = 'Pernyataan';
$strStatus = 'Status';
$strStrucCSV = 'Data CSV';
$strStrucData = 'Struktur dan data';
$strStrucDrop = 'Tambah \'Hapus tabel\'';
$strStrucExcelCSV = 'CSV untuk data MS Excel';
$strStrucOnly = 'Struktur saja';
$strStructPropose = 'Ajukan struktur tabel';
$strStructure = 'Struktur';
$strSubmit = 'Kirim';
$strSuccess = 'Perintah SQL telah dilaksanakan dengan sukses';
$strSum = 'Jumlah';

$strTable = 'Tabel';
$strTableComments = 'Komentar tabel';
$strTableEmpty = 'Nama tabel kosong!';
$strTableHasBeenDropped = 'Tabel %s telah dihapus';
$strTableHasBeenEmptied = 'Tabel %s telah dikosongkan';
$strTableHasBeenFlushed = 'Tabel %s telah dibuangkan';
$strTableMaintenance = 'Pemeliharaan tabel';
$strTableOfContents = 'Daftar Isi';
$strTableStructure = 'Struktur dari tabel';
$strTableType = 'Jenis tabel';
$strTables = 'tabel %s';
$strTblPrivileges = 'Hak (privileges) khusus terhadap tabel';
$strTextAreaLength = ' Dikarenakan panjangnya,<br /> field ini tidak dapat di-edit ulang. ';
$strTheContent = 'Isi file telah disisipkan.';
$strTheContents = 'Isi file telah digantikan dengan isi tabel yang dipilih dengan primary atau unique key.';
$strTheTerminator = 'Pemisah field.';
$strThisHost = 'Host yang ini';
$strThisNotDirectory = 'Ini bukan direktori';
$strThreadSuccessfullyKilled = 'Sukses hentikan Thread %s.';
$strTime = 'Waktu';
$strTotal = 'jumlah';
$strTotalUC = 'Jumlah';
$strTraffic = 'Traffic';
$strType = 'Jenis';

$strUncheckAll = 'Uncheck semua';
$strUnique = 'Unik';
$strUnselectAll = 'Unselect semua';
$strUpdatePrivMessage = 'Hak Akses (privilege) untuk %s telah di-update.';
$strUpdateProfile = 'Update profil pengguna:';
$strUpdateProfileMessage = 'Profil pengguna telah di-update.';
$strUpdateQuery = 'Update proses pencarian';
$strUsage = 'Penggunaan';
$strUseBackquotes = 'Gunakan backquotes dengan nama tabel dan nama field';
$strUseTables = 'Gunakan tabel';
$strUseTextField = 'Gunakan text field';
$strUser = 'Pengguna';
$strUserAlreadyExists = 'Penguna %s sudah terdaftar!';
$strUserEmpty = 'Kata pengguna masih kosong!';
$strUserName = 'Nama pengguna';
$strUserNotFound = 'Penguna yang dipilih tidak ditemukan pada tabel hak (privilege table).';
$strUserOverview = 'Pandangan Umum Penguna';
$strUsers = 'Pengguna-Pengguna';
$strUsersDeleted = 'Penguna yang dipilih telah dihapus dengan sukses.';

$strValidateSQL = 'Mengesahkan (validate) SQL';
$strValidatorError = 'Pengesahan SQL tidak dapat disahkan. Mohon periksa kembali ekstension PHP yang diperlukan seperti tercatat dalam %sdocumentation%s.';
$strValue = 'Nilai';
$strVar = 'Variabel';
$strViewDump = 'Tampilkan Dump (Skema) dari tabel';
$strViewDumpDB = 'Tampilkan Dump (Skema) dari database';

$strWebServerUploadDirectory = 'direktori upload dari web-server';
$strWebServerUploadDirectoryError = 'Direktori yang telah ditetapkan untuk meng-upload tidak bisa dihubungi';
$strWelcome = 'Selamat Datang di %s';
$strWithChecked = 'Dengan pilihan:';
$strWritingCommentNotPossible = 'Penulisan komentar tidak bisa dilaksanakan';
$strWritingRelationNotPossible = 'Penulisan relasi tidak bisa dilaksanakan';
$strWrongUser = 'Nama Pengguna/Kata Sandi salah. Akses ditolak.';

$strYes = 'Ya';

$strZeroRemovesTheLimit = 'Perhatian: Merubah pilihan ini ke posisi 0 (zero) akan menghapus limit yang telah ditentukan.';
$strZip = '"Dikompress dengan Zip"';
// To translate


$strDBGContext = 'Context';  //to translate
$strDBGContextID = 'Context ID';  //to translate
$strDBGHits = 'Hits';  //to translate
$strDBGLine = 'Line';  //to translate
$strDBGMinTimeMs = 'Max time, ms';  //to translate
$strDBGMinTimeMs = 'Min time, ms';  //to translate
$strDBGModule = 'Module';  //to translate
$strDBGTimePerHitMs = 'Time/Hit, ms';  //to translate
$strDBGTotalTimeMs = 'Total time, ms';  //to translate

$strCantLoad = 'cannot load %s extension,<br />please check PHP Configuration';  //to translate
?>
