<?php
/* $Id$ */

/**
 * Czech language file by
 *   Michal Čihař <nijel at users.sourceforge.net>
 */

$charset = 'utf-8';
$allow_recoding = TRUE;
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('bajtů', 'kB', 'MB', 'GB');

$day_of_week = array('Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota');
$month = array('ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%a %e. %b %Y, %H:%M';

$timespanfmt = '%s dnů, %s hodin, %s minut a %s sekund';

$strAPrimaryKey = 'V&nbsp;tabulce %s byl vytvořen primární klíč';
$strAbortedClients = 'Přerušené';
$strAbsolutePathToDocSqlDir = 'Zadejte absolutní cestu docSQL adresáře na serveru';
$strAccessDenied = 'Přístup odepřen';
$strAction = 'Akce';
$strAddDeleteColumn = 'Přidat/Smazat sloupec';
$strAddDeleteRow = 'Přidat/Smazat řádek s&nbsp;podmínkou';
$strAddNewField = 'Přidat nový sloupec';
$strAddPriv = 'Přidat nové privilegium';
$strAddPrivMessage = 'Oprávnění bylo přidáno.';
$strAddPrivilegesOnDb = 'Přidat oprávnění pro databázi';
$strAddPrivilegesOnTbl = 'Přidat oprávnění pro tabulku';
$strAddSearchConditions = 'Přidat vyhledávací parametry (obsah dotazu po příkazu "WHERE"):';
$strAddToIndex = 'Přidat do indexu  &nbsp;%s&nbsp;sloupců';
$strAddUser = 'Přidat nového uživatele';
$strAddUserMessage = 'Uživatel byl přidán.';
$strAddedColumnComment = 'Přidán komentář ke sloupci';
$strAddedColumnRelation = 'Přidána relace pro sloupec';
$strAdministration = 'Správa';
$strAffectedRows = 'Ovlivněné řádky:';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Zpět';
$strAfterInsertNewInsert = 'Vložit další řádek';
$strAll = 'Všechno';
$strAllTableSameWidth = 'Zobrazit všechny tabulky stejnou šířkou';
$strAlterOrderBy = 'Změnit pořadí tabulky podle';
$strAnIndex = 'K&nbsp;tabulce %s byl přidán index';
$strAnalyzeTable = 'Analyzovat tabulku';
$strAnd = 'a';
$strAny = 'Jakýkoliv';
$strAnyColumn = 'Jakýkoliv sloupec';
$strAnyDatabase = 'Jakákoliv databáze';
$strAnyHost = 'Jakýkoliv počítač';
$strAnyTable = 'Jakákoliv tabulka';
$strAnyUser = 'Jakýkoliv uživatel';
$strAscending = 'Vzestupně';
$strAtBeginningOfTable = 'Na začátku tabulky';
$strAtEndOfTable = 'Na konci tabulky';
$strAttr = 'Vlastnosti';

$strBack = 'Zpět';
$strBeginCut = 'ZAČÁTEK VÝPISU';
$strBeginRaw = 'ZAČÁTEK VÝPISU';
$strBinary = ' Binární ';
$strBinaryDoNotEdit = ' Binární - neupravujte ';
$strBookmarkDeleted = 'Položka byla smazána z&nbsp;oblíbených.';
$strBookmarkLabel = 'Název';
$strBookmarkQuery = 'Oblíbený SQL dotaz';
$strBookmarkThis = 'Přidat tento SQL dotaz do oblíbených';
$strBookmarkView = 'Jen zobrazit';
$strBrowse = 'Projít';
$strBzError = 'phpMyAdminovi se nepodařilo zkomprimovat výpis, protože rozšíření pro kompresi Bz2 je v&nbsp;této verzi php chybné. Doporučujeme nastavit <code>$cfg[\'BZipDump\']</code> v&nbsp;nastaveních phpMyAdmina na <code>FALSE</code>. Pokud chcete používat kompresi Bz2, měli byste nainstalovat novější verzi php. Více informací o&nbsp;tomto probnélu je u popisu chyby %s.';
$strBzip = '"zabzipováno"';

$strCannotLogin = 'Nepodařilo se přihlášení k MySQL serveru';
$strCantLoad = 'nelze nahrát rozšíření %s,<br />prosím zkontolujte nastavení PHP';
$strCantLoadMySQL = 'nelze nahrát rozšíření pro MySQL,<br />prosím zkontrolujte nastavení PHP.';
$strCantLoadRecodeIconv = 'Nelze nahrát rozšíření iconv ani recode potřebná pro převod znakových sad. Upravte nastavení php tak aby umožňovalo použít tyto rozšíření nebo vypněte převod znakových sad v&nbsp;phpMyAdminu.';
$strCantRenameIdxToPrimary = 'Index nemůžete přejmenovat na "PRIMARY"!';
$strCantUseRecodeIconv = 'Nelze použít funkce iconv ani libiconv ani recode_string, přestože rozšíření jsou nahrána. Zkontrolujte nastavení php.';
$strCardinality = 'Mohutnost';
$strCarriage = 'Návrat vozíku (CR): \\r';
$strChange = 'Změnit';
$strChangeDisplay = 'Zvolte které sloupce zobrazit';
$strChangePassword = 'Změnit heslo';
$strCharsetOfFile = 'Znaková sada souboru:';
$strCheckAll = 'Zaškrtnout vše';
$strCheckDbPriv = 'Zkontrolovat oprávnění pro databázi';
$strCheckTable = 'Zkontrolovat tabulku';
$strChoosePage = 'Zvolte stránku, kterou chcete změnit';
$strColComFeat = 'Zobrazuji komentáře sloupců';
$strColumn = 'Sloupec';
$strColumnNames = 'Názvy sloupců';
$strColumnPrivileges = 'Oprávnění pro jednotlivé sloupce';
$strCommand = 'Příkaz';
$strComments = 'Komentáře';
$strCompleteInserts = 'Úplné inserty';
$strCompression = 'Komprese';
$strConfigFileError = 'phpMyAdmin nemohl načíst konfigurační soubor!<br />Tato chyba může nastat pokud v&nbsp;něm php najde chybu nebo nemůže tento soubor najít.<br />Po kliknutí na následující odkaz se konfigurace spustí a budou zobrazeny informace o&nbsp;chybě, ke které došlo. Pak opravte tuto chybu (nejčastěji se jedná o&nbsp;chybějící středník).<br />Pokud získáte prázdnou stránku, všechno je v&nbsp;pořádku.';
$strConfigureTableCoord = 'Prosím, nastavte souřadnice pro tabulku %s';
$strConfirm = 'Opravdu chcete toto provést?';
$strConnections = 'Připojení';
$strCookiesRequired = 'Během tohoto kroku musíte mít povoleny cookies.';
$strCopyTable = 'Kopírovat tabulku do (databáze<b>.</b>tabulka):';
$strCopyTableOK = 'Tabulka %s byla zkopírována do %s.';
$strCouldNotKill = 'phpMyAdminovi se nepodařilo zabít vlákno %s. Pravděpodobne jeho běh již skončil.';
$strCreate = 'Vytvořit';
$strCreateIndex = 'Vytvořit index na&nbsp;%s&nbsp;sloupcích';
$strCreateIndexTopic = 'Vytvořit nový index';
$strCreateNewDatabase = 'Vytvořit novou databázi';
$strCreateNewTable = 'Vytvořit novou tabulku v&nbsp;databázi %s';
$strCreatePage = 'Vytvořit novou stránku';
$strCreatePdfFeat = 'Vytváření PDF';
$strCriteria = 'Podmínka';

$strDBGContext = 'Kontext';
$strDBGContextID = 'Kontext ID';
$strDBGHits = 'Zásahů';
$strDBGLine = 'Řádka';
$strDBGMinTimeMs = 'Max. čas, ms';
$strDBGMinTimeMs = 'Min. čas, ms';
$strDBGModule = 'Modul';
$strDBGTimePerHitMs = 'Čas/Zásah, ms';
$strDBGTotalTimeMs = 'Celkový čas, ms';
$strData = 'Data';
$strDataDict = 'Datový slovník';
$strDataOnly = ' Jen data';
$strDatabase = 'Databáze ';
$strDatabaseHasBeenDropped = 'Databáze %s byla zrušena.';
$strDatabaseWildcard = 'Databáze (zástupné znaky povoleny):';
$strDatabases = 'databáze';
$strDatabasesStats = 'Statistiky databází';
$strDbPrivileges = 'Oprávnění pro jednotlivé databáze';
$strDefault = 'Výchozí';
$strDelete = 'Smazat';
$strDeleteAndFlush = 'Odstranit uživatele a znovunačíst oprávnění.';
$strDeleteAndFlushDescr = 'Toto je nejčistčí řešení, ale načítání oprávnění může trvat dlouho.';
$strDeleteFailed = 'Smazání selhalo!';
$strDeleteUserMessage = 'Byl smazán uživatel %s.';
$strDeleted = 'Řádek byl smazán';
$strDeletedRows = 'Smazané řádky:';
$strDeleting = 'Odstraňuji %s';
$strDescending = 'Sestupně';
$strDisabled = 'Vypnuto';
$strDisplay = 'Zobrazit';
$strDisplayFeat = 'Zobrazení funkcí';
$strDisplayOrder = 'Seřadit podle:';
$strDisplayPDF = 'Zobrazit jako schéma v&nbsp;PDF';
$strDoAQuery = 'Provést "dotaz podle příkladu" (zástupný znak: "%")';
$strDoYouReally = 'Opravdu si přejete vykonat příkaz';
$strDocu = 'Dokumentace';
$strDrop = 'Odstranit';
$strDropDB = 'Odstranit databázi %s';
$strDropTable = 'Smazat tabulku';
$strDropUsersDb = 'Odstranit databáze se stejnými jmény jako uživatelé.';
$strDumpXRows = 'Vypsat %s řádků od %s.';
$strDumpingData = 'Dumpuji data pro tabulku';
$strDynamic = 'dynamický';

$strEdit = 'Upravit';
$strEditPDFPages = 'Upravit PDF stránky';
$strEditPrivileges = 'Upravit oprávnění';
$strEffective = 'Efektivní';
$strEmpty = 'Vyprázdnit';
$strEmptyResultSet = 'MySQL vrátil prázdný výsledek (tj. nulový počet řádků).';
$strEnabled = 'Zapnuto';
$strEnd = 'Konec';
$strEndCut = 'KONEC VÝPISU';
$strEndRaw = 'KONEC VÝPISU';
$strEnglishPrivileges = 'Poznámka: názvy oprávnění v&nbsp;MySQL jsou uváděny anglicky';
$strError = 'Chyba';
$strExplain = 'Vysvětlit (EXPLAIN) SQL';
$strExport = 'Export';
$strExportToXML = 'Export do XML';
$strExtendedInserts = 'Rozšířené inserty';
$strExtra = 'Extra';

$strFailedAttempts = 'Nepovedených pokusů';
$strField = 'Sloupec';
$strFieldHasBeenDropped = 'Sloupec %s byl odstraněn';
$strFields = 'Sloupce';
$strFieldsEmpty = ' Nebyl zadán počet sloupců! ';
$strFieldsEnclosedBy = 'Názvy sloupců uzavřené do';
$strFieldsEscapedBy = 'Názvy sloupců escapovány';
$strFieldsTerminatedBy = 'Sloupce oddělené';
$strFileCouldNotBeRead = 'Soubor nelze přečíst';
$strFixed = 'pevný';
$strFlushPrivilegesNote = 'Poznámka: phpMyAdmin získává oprávnění přímo z&nbsp;tabulek MySQL. Obsah těchto tabulek se může lišit od oprávnění, která server právě používá, pokud byly tyto tabulky upravovány. V&nbsp;tomto případě je vhodné provést %sznovunačtení oprávnění%s před pokračováním.';
$strFlushTable = 'Vyprázdnit vyrovnávací paměť pro tabulku ("FLUSH")';
$strFormEmpty = 'Chybějící hodnota ve formuláři!';
$strFormat = 'Formát';
$strFullText = 'Celé texty';
$strFunction = 'Funkce';

$strGenBy = 'Vygeneroval';
$strGenTime = 'Vygenerováno';
$strGeneralRelationFeat = 'Obecné funkce relací';
$strGlobalPrivileges = 'Globální oprávnění';
$strGlobalValue = 'Globální hodnota';
$strGo = 'Proveď';
$strGrantOption = 'Přidělování';
$strGrants = 'Přidělování';
$strGzip = '"zagzipováno"';

$strHasBeenAltered = 'byla změněna.';
$strHasBeenCreated = 'byla vytvořena.';
$strHaveToShow = 'Musíte volit alespoň jeden sloupec, který chcete zobrazit.';
$strHome = 'Hlavní strana';
$strHomepageOfficial = 'Oficiální stránka phpMyAdmina';
$strHomepageSourceforge = 'Nová stránka phpMyAdmina';
$strHost = 'Počítač';
$strHostEmpty = 'Jméno počítače je prázdné!';

$strId = 'ID';
$strIdxFulltext = 'Fulltext';
$strIfYouWish = 'Pokud si přejete natáhnout jen vybrané sloupce z&nbsp;tabulky, napište je jako seznam sloupců oddělených čárkou.';
$strIgnore = 'Ignorovat';
$strIgnoringFile = 'Ignoruji soubor %s';
$strImportDocSQL = 'Importovat soubory docSQL';
$strImportFiles = 'Importovat soubory';
$strImportFinished = 'Import ukončen';
$strInUse = 'právě se používá';
$strIndex = 'Index';
$strIndexHasBeenDropped = 'Index %s byl odstraněn';
$strIndexName = 'Jméno indexu&nbsp;:';
$strIndexType = 'Typ indexu&nbsp;:';
$strIndexes = 'Indexy';
$strInsecureMySQL = 'Váš konfigurační soubor obsahuje nastavení (uživatel root bez hesla), které je výchozí pro MySQL. Váš MySQL server s&nbsp;tímto výchozím nastavením je snadno napadnutelný, a proto byste měli změnit toto nastavení a tím podstatně zvýšit bezpečnost Vašeho serveru.';
$strInsert = 'Vložit';
$strInsertAsNewRow = 'Vložit jako nový řádek';
$strInsertNewRow = 'Vložit nový řádek';
$strInsertTextfiles = 'Vložit textové soubory do tabulky';
$strInsertedRows = 'Vloženo řádků:';
$strInstructions = 'Instrukce';
$strInvalidName = '"%s" je rezervované slovo a proto ho nemůžete požít jako jméno databáze/tabulky/sloupce.';

$strJustDelete = 'Jen odstranit uživatele z tabulek s oprávněními.';
$strJustDeleteDescr = 'Odstranění uživatelé stále budou mít přistup na server dokud nebudou znovunačtena oprávnění.';

$strKeepPass = 'Neměnit heslo';
$strKeyname = 'Klíčový název';
$strKill = 'Zabít';

$strLaTeX = 'LaTeX';
$strLandscape = 'Na šířku';
$strLength = 'Délka';
$strLengthSet = 'Délka/Množina*';
$strLimitNumRows = 'záznamů na stránku';
$strLineFeed = 'Ukončení řádku (Linefeed): \\n';
$strLines = 'Řádek';
$strLinesTerminatedBy = 'Řádky ukončené';
$strLinkNotFound = 'Odkaz nenalezen';
$strLinksTo = 'Odkazuje na';
$strLocalhost = 'Lokální';
$strLocationTextfile = 'textový soubor';
$strLogPassword = 'Heslo:';
$strLogUsername = 'Jméno:';
$strLogin = 'Přihlášení';
$strLoginInformation = 'Přihlašování';
$strLogout = 'Odhlásit se';

$strMissingBracket = 'Chybí závorka';
$strModifications = 'Změny byly uloženy';
$strModify = 'Úpravy';
$strModifyIndexTopic = 'Upravit index';
$strMoreStatusVars = 'Další informace o&nbsp;stavu';
$strMoveTable = 'Přesunout tabulku do (databáze<b>.</b>tabulka):';
$strMoveTableOK = 'Tabulka %s byla přesunuta do %s.';
$strMySQLCharset = 'Znaková sada v&nbsp;MySQL';
$strMySQLReloaded = 'MySQL znovu načteno.';
$strMySQLSaid = 'MySQL hlásí: ';
$strMySQLServerProcess = 'MySQL %pma_s1% spuštěné na %pma_s2%, přihlášen %pma_s3%';
$strMySQLShowProcess = 'Zobrazit procesy';
$strMySQLShowStatus = 'Ukázat MySQL informace o&nbsp;běhu';
$strMySQLShowVars = 'Ukázat MySQL systémové proměnné';

$strName = 'Název';
$strNext = 'Další';
$strNo = 'Ne';
$strNoDatabases = 'Žádné databáze';
$strNoDescription = 'žádný popisek';
$strNoDropDatabases = 'Příkaz "DROP DATABASE" je vypnutý.';
$strNoExplain = 'Bez vysvětlení (EXPLAIN) SQL';
$strNoFrames = 'phpMyAdmin se lépe používá v&nbsp;prohlížeči podporujícím rámy ("FRAME").';
$strNoIndex = 'Žádný index nebyl definován!';
$strNoIndexPartsDefined = 'Žádná část indexu nebyla definována!';
$strNoModification = 'Žádná změna';
$strNoPassword = 'Žádné heslo';
$strNoPhp = 'Bez PHP kódu';
$strNoPrivileges = 'Bez oprávnění';
$strNoQuery = 'Žádný SQL dotaz!';
$strNoRights = 'Nemáte dostatečná práva na provedení této akce!';
$strNoTablesFound = 'V&nbsp;databázi nebyla nalezena ani jedna tabulka.';
$strNoUsersFound = 'Žádný uživatel nenalezen.';
$strNoUsersSelected = 'Nebyl vybrán žádný uživatel.';
$strNoValidateSQL = 'Bez kontroly SQL';
$strNone = 'Žádná';
$strNotNumber = 'Toto není číslo!';
$strNotOK = 'není OK';
$strNotSet = '<b>%s</b> tabulka nenalezena nebo není nastavena v&nbsp;%s';
$strNotValidNumber = ' není platné číslo řádku!';
$strNull = 'Nulový';
$strNumSearchResultsInTable = '%s odpovídající(ch) záznam(ů) v&nbsp;tabulce <i>%s</i>';
$strNumSearchResultsTotal = '<b>Celkem:</b> <i>%s</i> odpovídající(ch) záznam(ů)';
$strNumTables = 'Tabulek';

$strOK = 'OK';
$strOftenQuotation = 'Často uvozující znaky. Volitelně znamená, že pouze položky u kterých je to nutné (obvykle typu CHAR a VARCHAR) jsou uzavřeny do uzavíracích znaků.';
$strOperations = 'Úpravy';
$strOptimizeTable = 'Optimalizovat tabulku';
$strOptionalControls = 'Volitelné. Určuje jak zapisovat nebo číst speciální znaky.';
$strOptionally = 'Volitelně';
$strOptions = 'Vlastnosti';
$strOr = 'nebo';
$strOverhead = 'Navíc';

$strPHP40203 = 'Používáte PHP 4.2.3, které má závažnou chybu při práci s&nbsp;vícebajtovými znaky (mbsting), jedná se o&nbsp;chybu PHP číslo 19404. Nedoporučujeme používat tuto verzi PHP s&nbsp;phpMyAdminem.';
$strPHPVersion = 'Verze PHP';
$strPageNumber = 'Strana číslo:';
$strPartialText = 'Zkrácené texty';
$strPassword = 'Heslo';
$strPasswordChanged = 'Heslo pro %s bylo úspěšně změněno.';
$strPasswordEmpty = 'Heslo je prázdné!';
$strPasswordNotSame = 'Hesla nejsou stejná!';
$strPdfDbSchema = 'Schéma databáze "%s" - Strana %s';
$strPdfInvalidPageNum = 'Nedefinované číslo stránky v&nbsp;PDF!';
$strPdfInvalidTblName = 'Tabulka "%s" neexistuje!';
$strPdfNoTables = 'žádné tabulky';
$strPerHour = 'za hodinu';
$strPhp = 'Zobrazit PHP kód';
$strPmaDocumentation = 'Dokumentace phpMyAdmina';
$strPmaUriError = 'Parametr <tt>$cfg[\'PmaAbsoluteUri\']</tt> MUSÍ být nastaven v&nbsp;konfiguračním souboru!';
$strPortrait = 'Na výšku';
$strPos1 = 'Začátek';
$strPrevious = 'Předchozí';
$strPrimary = 'Primární';
$strPrimaryKey = 'Primární klíč';
$strPrimaryKeyHasBeenDropped = 'Primární klíč byl odstraněn';
$strPrimaryKeyName = 'Jméno primárního klíče musí být "PRIMARY"!';
$strPrimaryKeyWarning = '("PRIMARY" <b>musí</b> být jméno <b>pouze</b> primárního klíče!)';
$strPrint = 'Vytisknout';
$strPrintView = 'Náhled k vytištění';
$strPrivDescAllPrivileges = 'Všechna oprávnění kromě GRANT.';
$strPrivDescAlter = 'Umožňuje měnit strukturu existujících tabulek.';
$strPrivDescCreateDb = 'Umožňuje vytvářet nové databáze a tabulky.';
$strPrivDescCreateTbl = 'Umožňuje vytvářet nové tabulky.';
$strPrivDescCreateTmpTable = 'Umožňuje vytvářet dočasné tabulky.';
$strPrivDescDelete = 'Umožňuje mazat data.';
$strPrivDescDropDb = 'Umožňuje odstranit databáze a tabulky.';
$strPrivDescDropTbl = 'Umožňuje odstranit tabulky.';
$strPrivDescExecute = 'Umožnuje spouštět uložené procedury. V&nbsp;této verzi MySQL se nepoužívá.';
$strPrivDescFile = 'Umožňuje importovat a exportovat data z/do souborů na serveru.';
$strPrivDescGrant = 'Umožňuje přidávat uživatele a oprávnění bez znovunačítání tabulek s&nbsp;oprávněními.';
$strPrivDescIndex = 'Umožňuje vytvářet a rušit indexy.';
$strPrivDescInsert = 'Umožňuje vkládata a přepisovat data.';
$strPrivDescLockTables = 'Umožňuje zamknout tabulku pro aktuální thread.';
$strPrivDescMaxConnections = 'Omezí počet nových připojení, která může uživatel vytvořit za hodinu.';
$strPrivDescMaxQuestions = 'Omezí kolik dotazů může uživatel odeslat serveru za hodinu.';
$strPrivDescMaxUpdates = 'Omezí kolik dotazů, které mění nejakou tabulku nebo databázi, může uživatel spustit za hodinu.';
$strPrivDescProcess3 = 'Umožňuje zabíjet procesy jiným uživatelům.';
$strPrivDescProcess4 = 'Umožňuje vidět kompletní dotazy v&nbsp;seznamu procesů.';
$strPrivDescReferences = 'Nemá žádný vliv v&nbsp;této verzi MySQL.';
$strPrivDescReload = 'Umožňuje znovunačítání nastavení serveru a vyprázdnění vyrovnávacích pamětí serveru.';
$strPrivDescReplClient = 'Umožní uživateli zjistit kde je hlavní / pomocný server.';
$strPrivDescReplSlave = 'Potřebné pro replikaci pomocných serverů.';
$strPrivDescSelect = 'Umožňuje číst data.';
$strPrivDescShowDb = 'Dává přístup k&nbsp;úplnému seznamu databází.';
$strPrivDescShutdown = 'Umožňuje vypnout server.';
$strPrivDescSuper = 'Umožňuje připojení i když je dosažen maximální počet připojení. Potřebné pro většinu operací pro správu serveru jako nastavování globálních proměnných a zabíjení threadů jiných uživatelů.';
$strPrivDescUpdate = 'Umožňuje měnit data.';
$strPrivDescUsage = 'Žádná oprávnění.';
$strPrivileges = 'Oprávnění';
$strPrivilegesReloaded = 'Oprávnění byla znovunačtena úspěšně.';
$strProcesslist = 'Seznam procesů';
$strProperties = 'Vlastnosti';
$strPutColNames = 'Přidat jména sloupců na první řádek';

$strQBE = 'Dotaz';
$strQBEDel = 'smazat';
$strQBEIns = 'přidat';
$strQueryOnDb = 'SQL dotaz na databázi <b>%s</b>:';
$strQueryStatistics = '<b>Statistika dotazů</b>: Od spuštění bylo serveru posláno %s dotazů.';
$strQueryType = 'Typ dotazu';

$strReType = 'Heslo znovu';
$strReceived = 'Přijato';
$strRecords = 'Záznamů';
$strReferentialIntegrity = 'Zkontrolovat integritu odkazů:';
$strRelationNotWorking = 'Některé funkce pro práci s&nbsp;propojenými tabulkami byly vypnuty. %sZde%s zjistíte proč.';
$strRelationView = 'Zobrazit relace';
$strRelationalSchema = 'Relační schéma';
$strReloadFailed = 'Znovunačtení MySQL selhalo.';
$strReloadMySQL = 'Znovunačtení MySQL';
$strReloadingThePrivileges = 'Znovunačítám oprávnění';
$strRememberReload = 'Nezapomeňte znovu načíst server.';
$strRemoveSelectedUsers = 'Odstranit vybrané uživatele';
$strRenameTable = 'Přejmenovat tabulku na';
$strRenameTableOK = 'Tabulka %s byla přejmenována na %s';
$strRepairTable = 'Opravit tabulku';
$strReplace = 'Přepsat';
$strReplaceTable = 'Přepsat data tabulky souborem';
$strReset = 'Původní (reset)';
$strResourceLimits = 'Omezení zdrojů';
$strRevoke = 'Zrušit';
$strRevokeAndDelete = 'Odebrat uživatelům veškerá oprávnění a poté je odstranit z tabulek.';
$strRevokeAndDeleteDescr = 'Uživatelé budou mít oprávnění "USAGE" (používání) dokud nebudou znovunačtena oprávnění.';
$strRevokeGrant = 'Zrušit oprávnění přidělovat práva';
$strRevokeGrantMessage = 'Bylo zrušeno oprávnění přidělovat práva pro %s';
$strRevokeMessage = 'Byla zrušena práva pro %s';
$strRevokePriv = 'Zrušit práva';
$strRowLength = 'Délka řádku';
$strRowSize = ' Velikost řádku ';
$strRows = 'Řádků';
$strRowsFrom = 'řádků začínající od';
$strRowsModeHorizontal = 'vodorovném';
$strRowsModeOptions = 've %s režimu a opakovat hlavičky po %s řádcích.';
$strRowsModeVertical = 'svislém';
$strRowsStatistic = 'Statistika řádků';
$strRunQuery = 'Provést dotaz';
$strRunSQLQuery = 'Spustit SQL dotaz(y) na databázi %s';
$strRunning = 'na %s';

$strSQL = 'SQL';
$strSQLParserBugMessage = 'Je možné, že jste našli chybu v&nbsp;SQL parseru. Prosím prozkoumejte podrobně SQL dotaz, především jestli jsou správně uvozovky a jestli nejsou proházené. Další možnost selhání je pokud nahráváte soubor s&nbsp;binárními daty nezapsanými v&nbsp;uvozovkách. Můžete také vyzkoušet příkazovou řádku MySQL. Níže uvedený výstup z&nbsp;MySQL serveru (pokud je nějaký) Vám také může pomoci při zkoumání problému. Pokud stále máte problémy nebo pokud SQL parser ohlásí chybu u dotazu, který na příkazové řádce funguje, prosím pokuste se zredukovat dotaz na co nejmenší, ve kterém se problém ještě vyskytne, a ohlašte chybu na stránkách phpMyAdmina spolu se sekcí VÝPIS uvedenou níže:';
$strSQLParserUserError = 'Pravděpodobně máte v&nbsp;SQL dotazu chybu. Níže uvedený výstup MySQL serveru (pokud je nějaký) Vám také může pomoci při zkoumání problému';
$strSQLQuery = 'SQL-dotaz';
$strSQLResult = 'Výsledek SQL dotazu';
$strSQPBugInvalidIdentifer = 'Chybný identifikátor';
$strSQPBugUnclosedQuote = 'Neuzavřené uvozovky';
$strSQPBugUnknownPunctuation = 'Neznámé interpunkční znaménko';
$strSave = 'Ulož';
$strScaleFactorSmall = 'Měřítko je příliš malé, aby se schéma vešlo na jednu stránku';
$strSearch = 'Vyhledávání';
$strSearchFormTitle = 'Vyhledávání v&nbsp;databázi';
$strSearchInTables = 'V&nbsp;tabulkách:';
$strSearchNeedle = 'Slova nebo hodnoty, které chcete vyhledat (zástupný znak: "%"):';
$strSearchOption1 = 'alespoň jedno ze slov';
$strSearchOption2 = 'všechna slova';
$strSearchOption3 = 'přesnou frázi';
$strSearchOption4 = 'jako regulární výraz';
$strSearchResultsFor = 'Výsledny vyhledávání pro "<i>%s</i>" %s:';
$strSearchType = 'Najít:';
$strSelect = 'Vybrat';
$strSelectADb = 'Prosím vyberte databázi';
$strSelectAll = 'Vybrat vše';
$strSelectFields = 'Zvolte sloupec (alespoň jeden):';
$strSelectNumRows = 'v&nbsp;dotazu';
$strSelectTables = 'Vybrat tabulky';
$strSend = 'Poslat';
$strSent = 'Odesláno';
$strServer = 'Server %s';
$strServerChoice = 'Výběr serveru';
$strServerStatus = 'Stav serveru';
$strServerStatusUptime = 'Tento MySQL server beží %s. Spuštěn byl v&nbsp;%s.';
$strServerTabProcesslist = 'Procesy';
$strServerTabVariables = 'Proměnné';
$strServerTrafficNotes = '<b>Provoz serveru</b>: Informace o&nbsp;síťovém provozu MySQL serveru od jeho spuštění.';
$strServerVars = 'Proměnné a nastavení serveru';
$strServerVersion = 'Verze MySQL';
$strSessionValue = 'Hodnota sezení';
$strSetEnumVal = 'Pokud je sloupec typu "enum" nebo "set", zadávejte hodnoty v&nbsp;následujícím formátu: \'a\',\'b\',\'c\'...<br />Pokud potřebujete zadat zpětné lomítko ("\") nebo jednoduché uvozovky ("\'") mezi těmito hodnotami, napište před ně zpětné lomítko (příklad: \'\\\\xyz\' nebo \'a\\\'b\').';
$strShow = 'Zobrazit';
$strShowAll = 'Zobrazit vše';
$strShowColor = 'Barevné šipky';
$strShowCols = 'Zobrazit sloupce';
$strShowDatadictAs = 'Formát datového slovníku';
$strShowGrid = 'Zobrazit mřížku';
$strShowPHPInfo = 'Zobrazit informace o&nbsp;PHP';
$strShowTableDimension = 'Rozměry tabulek';
$strShowTables = 'Zobrazit tabulky';
$strShowThisQuery = 'Zobrazit zde tento dotaz znovu';
$strShowingRecords = 'Zobrazeny záznamy';
$strSingly = '(po jednom)';
$strSize = 'Velikost';
$strSort = 'Řadit';
$strSpaceUsage = 'Využití místa';
$strSplitWordsWithSpace = 'Slova jsou oddělena mezerou (" ").';
$strStatement = 'Údaj';
$strStatus = 'Stav';
$strStrucCSV = 'CSV data';
$strStrucData = 'Strukturu a data';
$strStrucDrop = 'Přidej \'DROP TABLE\'';
$strStrucExcelCSV = 'CSV data pro MS Excel';
$strStrucOnly = 'Pouze strukturu';
$strStructPropose = 'Navrhnout strukturu tabulky';
$strStructure = 'Struktura';
$strSubmit = 'Odešli';
$strSuccess = 'Váš SQL-dotaz byl úspěšně vykonán';
$strSum = 'Celkem';

$strTable = 'Tabulka';
$strTableComments = 'Komentář k tabulce';
$strTableEmpty = 'Jméno tabulky je prázdné!';
$strTableHasBeenDropped = 'Tabulka %s byla odstraněna';
$strTableHasBeenEmptied = 'Tabulka %s byla vyprázdněna';
$strTableHasBeenFlushed = 'Vyrovnávací paměť pro tabulku %s byla vyprázdněna';
$strTableMaintenance = ' Údržba tabulky ';
$strTableOfContents = 'Obsah';
$strTableStructure = 'Struktura tabulky';
$strTableType = 'Typ tabulky';
$strTables = '%s tabulek';
$strTblPrivileges = 'Oprávnění pro jednotlivé tabulky';
$strTextAreaLength = 'Tento sloupec možná nepůjde <br />(kvůli délce) upravit ';
$strTheContent = 'Obsah souboru byl vložen';
$strTheContents = 'Obsah souboru přepíše obsah zvolené tabulky v&nbsp;těch řádcích, kde je stejný primární nebo unikátní klíč.';
$strTheTerminator = 'Sloupce jsou odděleny tímto znakem.';
$strThisHost = 'Tento počítač';
$strThisNotDirectory = 'Nebyl zadán adresář';
$strThreadSuccessfullyKilled = 'Vlákno %s bylo úspěšne zabito.';
$strTime = 'Čas';
$strTotal = 'celkem';
$strTotalUC = 'Celkem';
$strTraffic = 'Provoz';
$strType = 'Typ';

$strUncheckAll = 'Odškrtnout vše';
$strUnique = 'Unikátní';
$strUnselectAll = 'Odznačit vše';
$strUpdatePrivMessage = 'Byla aktualizovana oprávnění pro %s.';
$strUpdateProfile = 'Změny přístupu:';
$strUpdateProfileMessage = 'Přístup byl změněn.';
$strUpdateQuery = 'Aktualizovat dotaz';
$strUsage = 'Používá';
$strUseBackquotes = 'Použít zpětné uvozovky u&nbsp;jmen tabulek a sloupců';
$strUseTables = 'Použít tabulky';
$strUseTextField = 'Použít textové pole';
$strUser = 'Uživatel';
$strUserAlreadyExists = 'Uživatel %s již existuje!';
$strUserEmpty = 'Jméno uživatele je prázdné!';
$strUserName = 'Jméno uživatele';
$strUserNotFound = 'Zvolený uživatel nebyl nalezen v&nbsp;tabulce oprávnění.';
$strUserOverview = 'Přehled uživatelů';
$strUsers = 'Uživatelé';
$strUsersDeleted = 'Vybraní uživatelé byli úspěšně odstraněni.';

$strValidateSQL = 'Zkontrolovat SQL';
$strValidatorError = 'SQL validator nemohl být inicializován. Prosím zkontrolujte jestli máte nainstalované potřebné rozšíření php, jak je popsáno v&nbsp;%sdokumentaci%s.';
$strValue = 'Hodnota';
$strVar = 'Proměnná';
$strViewDump = 'Zobrazit výpis (dump) tabulky';
$strViewDumpDB = 'Zobrazit výpis (dump) databáze';

$strWebServerUploadDirectory = 'soubor z&nbsp;adresáře pro upload';
$strWebServerUploadDirectoryError = 'Adresář určený pro upload souborů nemohl být otevřen';
$strWelcome = 'Vítej v&nbsp;%s';
$strWithChecked = 'Zaškrtnuté:';
$strWritingCommentNotPossible = 'Nelze zapsat komentář';
$strWritingRelationNotPossible = 'Nelze zapsat relaci';
$strWrongUser = 'Špatné uživatelské jméno/heslo. Přístup odepřen.';

$strYes = 'Ano';

$strZeroRemovesTheLimit = 'Poznámka: Nastavení těchto parametrů na 0 (nulu) odstraní omezení.';
$strZip = '"zazipováno"';
// To translate

?>
