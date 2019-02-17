<?php

/**
 * Messages language file
 * @author Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2011-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
$lang = array(
    'LOGIN_FAILED' => 'Der Benutzername oder das Passwort ist falsch. Bitte versuche es erneut.',
    'LOGIN_FAILED_DISABLED' => 'Der angegebene Benutzername wurde deaktiviert.',
    'LOGIN_REQUIRED' => 'Bitte melde dich an, um die angeforderte Seite aufrufen zu können!',
    'LOGIN_PASSWORD_RESET' => 'Dein Passwort wurde erfolgreich zurückgesetzt! Prüfe deinen Posteingang auf die E-Mail mit dem neuen Passwort.',
    'LOGIN_PASSWORD_RESET_FAILED' => 'Beim Anfordern eines neues Passworts ist ein Fehler aufgetreten!',
    'LOGIN_ATTEMPTS_MAX' => 'Du hast deinen Benutzername oder Passwort {{logincount}}-mal falsch eingeben. Der Zugang wurde um {{lockeddate}} für {{lockedtime}} Minuten gesperrt.',
    'PERMISSIONS_REQUIRED' => 'Du hast keine Berechtigungen um auf diese Seite zuzugreifen!',
    'VIEW_NOT_FOUND' => 'Die View {{viewname}} wurde nicht gefunden!',
    'AJAX_REQUEST_ERROR' => 'Beim Ausführen der Aktion ist ein Fehler aufgetreten! Weitere Informationen findest du im Javascript-Log deines Browsers.',
    'AJAX_RESPONSE_ERROR' => 'Vom Server wurde eine ungültige Antwort geliefert! Weitere Informationen findest du im Javascript-Log deines Browsers und ggf. im PHP-Log.',
    'ERROR_IP_LOCKED' => 'Deine IP-Adresse wurde für diese Aktion gesperrt! Um den Grund zu erfahren wende dich an die Betreiber der Seite.',
    'CACHE_CLEARED_OK' => 'Der Cache wurde geleert!',
    'CONFIRM_MESSAGE' => 'Willst du diese Aktion wirklich durchführen?',
    'SELECT_ITEMS_MSG' => 'Bitte wähle Elemente oder eine Aktion aus!',
    'SEARCH_WAITMSG' => 'Bitte warte 10 Sekunden, bevor du einen neuen Suchvorgang durchführst.',
    'RSSFEED_DISABLED' => 'Der RSS-Feed ist deaktiviert. Wende dich an den Seitenbetreiber, um zu erfahren wieso.',
    'MAINTENANCE_MODE_ENABLED' => 'Der Wartungsmodus von FanPress CM ist gerade aktiv, daher steht diese Funktion im Moment nicht zur Verfügung.',
    'CSRF_INVALID' => 'Das CSRF-Token ist ungültig. Die Aktion wurde nicht durchgeführt!',
    'SESSION_TIMEOUT' => 'Es wurde festgestellt, dass deine aktuelle Session abgelaufen ist. Willst du zur Login-Seite gehen? (wähle "Nein" um auf der aktuellen Seite zu bleiben)',
    'FILE_NOT_WRITABLE' => 'Die ausgewählte Datei ist nicht beschreibbar, bitte prüfe die Berechtigungen auf dem Server.',
    'TEMPLATE_NOT_WRITABLE' => 'Das ausgewählte Template ist nicht beschreibbar, bitte prüfe die Berechtigungen auf dem Server.',
    'USERS_AUTHTOKEN_ACTIVE' => 'Die Zwei-Faktor-Authentifizierung ist aktiv.',
    'SAVE_SUCCESS_ADDUSER' => 'Der Benutzer wurde gespeichert!',
    'SAVE_SUCCESS_USER_DISABLE' => 'Der Benutzer wurde deaktiviert!',
    'SAVE_SUCCESS_USER_ENABLE' => 'Der Benutzer wurde aktiviert!',
    'SAVE_SUCCESS_ADDROLL' => 'Die Benutzerrolle wurde gespeichert!!',
    'SAVE_SUCCESS_ADDCATEGORY' => 'Die Kategorie wurde gespeichert!',
    'SAVE_SUCCESS_EDITUSER' => 'Die Änderungen am Benutzer wurden gespeichert!',
    'SAVE_SUCCESS_EDITUSER_PROFILE' => 'Die Änderungen an deinem Profil wurden gespeichert!',
    'SAVE_SUCCESS_RESETPROFILE' => 'Die Benutzereinstellungen wurden auf die Standardwerte zurückgesetzt!',
    'SAVE_SUCCESS_RESETDASHCONTAINER' => 'Die Dashboard-Container-Positionen wurden auf die Standardwerte zurückgesetzt!',
    'SAVE_SUCCESS_EDITROLL' => 'Die Änderungen an der Benutzerrolle wurden gespeichert!',
    'SAVE_SUCCESS_EDITCATEGORY' => 'Die Änderungen an der Kategorie wurden gespeichert!',
    'SAVE_SUCCESS_OPTIONS' => 'Die Änderungen an der Konfiguration wurde gespeichert!',
    'SAVE_SUCCESS_PERMISSIONS' => 'Die Änderungen an den Berechtigungen wurde gespeichert!',
    'SAVE_SUCCESS_SMILEY' => 'Der Smiley wurde gespeichert!',
    'SAVE_SUCCESS_IPADDRESS' => 'Die IP-Adresse wurde gesperrt!',
    'SAVE_SUCCESS_WORDBAN' => 'Der Begriff wurde gespeichert!',
    'SAVE_SUCCESS_UPLOADPHP' => 'Die Dateien wurden hochgeladen!<br>{{filenames}}',
    'SAVE_SUCCESS_TEMPLATE' => 'Das Template {{filename}} wurde gespeichert!<br>',
    'SAVE_SUCCESS_ARTICLETEMPLATE' => 'Die Artikel-Vorlage wurde gespeichert!',
    'SAVE_SUCCESS_ARTICLE' => 'Der Artikel wurde gespeichert!',
    'SAVE_SUCCESS_ARTICLE_APPROVAL' => 'Der Artikel wurde gespeichert, muss aber freigeschalten werden!',
    'SAVE_SUCCESS_ARTICLERESTORE' => 'Die Elemente wurden wiederhergestellt!',
    'SAVE_SUCCESS_ARTICLENEWTWEET' => 'Für die Artikel wurden neue Tweets erzeugt!<br>{{titles}}',
    'SAVE_SUCCESS_ARTICLEREVRESTORE' => 'Die Revision wurde wiederhergestellt!',
    'SAVE_SUCCESS_COMMENT' => 'Der Kommentar wurde gespeichert!',
    'SAVE_SUCCESS_UPLOADMODULE' => 'Die Modul-Paket-Datei wurde hochgeladen!',
    'SAVE_SUCCESS_UPLOADTPLFILE' => 'Die Vorlage wurde hochgeladen!',
    'SAVE_SUCCESS_UPLOADAUTHORIMG' => 'Der Avatar wurde hochgeladen!',
    'SAVE_FAILED_USER' => 'Der Benutzer konnte nicht gespeichert werden!',
    'SAVE_FAILED_USER_PROFILE' => 'Die Änderung am Profil konnten nicht gespeichert werden!',
    'SAVE_FAILED_USER_RESETDASHCONTAINER' => 'Die Dashboard-Container-Positionen konnten nicht gespeichert werden!',
    'SAVE_FAILED_USER_EXISTS' => 'Ein Benutzer mit dem gewählten Benutzername existiert bereits!',
    'SAVE_FAILED_USER_EMAIL' => 'Für den Benutzer wurde keine gültige E-Mail-Adresse angegeben!',
    'SAVE_FAILED_USER_PROFILEEMAIL' => 'Du musst eine gültige E-Mail-Adresse angegeben!',
    'SAVE_FAILED_USER_DISABLE' => 'Der Benutzer konnte nicht deaktiviert werden!',
    'SAVE_FAILED_USER_DISABLE_OWN' => 'Du kannst deinen eigenen Account nicht deaktivieren!',
    'SAVE_FAILED_USER_DISABLE_LAST' => 'Der letzte Benutzer kann nicht deaktiviert werden!',
    'SAVE_FAILED_USER_ENABLE' => 'Der Benutzer konnte nicht aktiviert werden!',
    'SAVE_FAILED_ROLL' => 'Die Benutzerrolle konnte nicht gespeichert werden!',
    'SAVE_FAILED_CATEGORY' => 'Die Kategorie konnte nicht gespeichert werden!',
    'SAVE_FAILED_PASSWORD_SECURITY' => 'Ein Password muss Groß- und Kleinbuchstaben sowie Zahlen enthalten und min. 6 Zeichen lang sein.',
    'SAVE_FAILED_PASSWORD_MATCH' => 'Die eingegebenen Passwörter stimmen nicht überein.',
    'SAVE_FAILED_PASSWORD_SECURITY' => 'Das eingegebene Passwort wird sehr häufig verwendet und ist daher potentiell gefährlich! Es sollte daher nicht verwendet werden.',
    'SAVE_FAILED_USER_SECURITY' => 'Der eingegebene Benutzername ist potentiell gefährlich und kann daher nicht verwendet werden!',
    'SAVE_FAILED_OPTIONS' => 'Die Änderungen an der Konfiguration konnten nicht gespeichert werden!',
    'SAVE_FAILED_OPTIONS_MODULES' => 'Die Änderungen an der Konfiguration konnten nicht gespeichert werden, da keine Daten im Feld "config" gefunden wurden.!',
    'SAVE_FAILED_PERMISSIONS' => 'Die Änderungen an den Berechtigungen für die ausgewählte Rolle konnten nicht gespeichert werden!',
    'SAVE_FAILED_SMILEY' => 'Der Smiley konnte nicht gespeichert werden!',
    'SAVE_FAILED_IPADDRESS' => 'Die IP-Adresse konnte nicht gesperrt werden!',
    'SAVE_FAILED_WORDBAN' => 'Der Begriff konnte nicht gespeichert werden!',
    'SAVE_FAILED_UPLOADPHP' => 'Beim hochladen der Dateien ist ein Fehler aufgetreten!<br>{{filenames}}',
    'SAVE_FAILED_TEMPLATE' => 'Beim Speichern des Templates {{filename}} ist ein Fehler aufgetreten!',
    'SAVE_FAILED_TEMPLATE_CF_URLMISSING' => 'Das Kommentar-Formular-Template konnte nicht gespeichert werden. Der Platzhalter {{submitUrl}} fehlt!',
    'SAVE_FAILED_TEMPLATE_CF_PRIVACYMISSING' => 'Das Kommentar-Formular-Template konnte nicht gespeichert werden. Der Platzhalter {{privacyComfirmation}} fehlt!',
    'SAVE_FAILED_ARTICLETEMPLATE' => 'Die Artikel-Vorlage konnte nicht gespeichert werden!',
    'SAVE_FAILED_ARTICLE' => 'Der Artikel konnte nicht gespeichert werden!',
    'SAVE_FAILED_ARTICLES' => 'Die Änderungen an den Artikeln konnte nicht gespeichert werden!',
    'SAVE_FAILED_ARTICLE_EMPTY' => 'Du musst einen Titel und einen Text eingeben, bevor du den Artikel speichern kannst!',
    'SAVE_FAILED_ARTICLEPINN' => 'Die Artikel konnten nicht (ab)gepinnt werden!',
    'SAVE_FAILED_ARTICLEARCHIVE' => 'Die Artikel konnten nicht archiviert werden!',
    'SAVE_FAILED_ARTICLERESTORE' => 'Die Elemente konnten nicht wiederhergestellt werden!',
    'SAVE_FAILED_ARTICLENEWTWEET' => 'Für die Artikel konnten keine Tweets erzeugt werden!<br>{{titles}}',
    'SAVE_FAILED_ARTICLECOMMENTS' => 'Die Kommentare konnten nicht für die Artikel (de)aktiviert werden!',
    'SAVE_FAILED_ARTICLEREVRESTORE' => 'Die Revision konnte nicht wiederhergestellt werden!',
    'SAVE_FAILED_ARTICLEAPPROVAL' => 'Die Artikel-Freigaben konnten nicht geändert werden!',
    'SAVE_FAILED_COMMENT' => 'Der Kommentar konnte nicht gespeichert werden!',
    'SAVE_FAILED_COMMENTS' => 'Die Änderungen an den Kommentaren konnten nicht gespeichert werden!',
    'SAVE_FAILED_UPLOADMODULE' => 'Beim Hochladen der Modul-Paket-Datei ist ein Fehler aufgetreten!',
    'SAVE_FAILED_UPLOADTPLFILE' => 'Beim Hochladen der Vorlage ist ein Fehler aufgetreten!',
    'SAVE_FAILED_UPLOADAUTHORIMG' => 'Beim Hochladen des Avatars ist ein Fehler aufgetreten!',
    'DELETE_SUCCESS_USERS' => 'Der Benutzer wurden gelöscht!',
    'DELETE_SUCCESS_ROLL' => 'Die Benutzerrolle wurden gelöscht!',
    'DELETE_SUCCESS_CATEGORIES' => 'Die Kategorien wurden gelöscht!',
    'DELETE_SUCCESS_FILES' => 'Die Dateien wurden gelöscht!<br>{{filenames}}',
    'DELETE_SUCCESS_FILEAUTHORIMG' => 'Der Avatar wurde gelöscht!',
    'DELETE_SUCCESS_NEWTHUMBS' => 'Neue Thumbnails wurden erzeugt!<br>{{filenames}}',
    'DELETE_SUCCESS_RENAME' => 'Die Datei wurde {{filename1}} in {{filename2}} umbenannt!',
    'DELETE_SUCCESS_SMILEYS' => 'Die Smileys wurden gelöscht!',
    'DELETE_SUCCESS_IPADDRESS' => 'Die IP-Adressen wurde(n) gelöscht!',
    'DELETE_SUCCESS_WORDBAN' => 'Die Begriffe wurden gelöscht!',
    'DELETE_SUCCESS_ARTICLE' => 'Die Artikel wurden gelöscht!',
    'DELETE_SUCCESS_REVISIONS' => 'Die Revisionen wurden gelöscht!',
    'DELETE_SUCCESS_TRASH' => 'Der Papierkorb wurde geleert!',
    'DELETE_SUCCESS_COMMENTS' => 'Die Kommentare wurden gelöscht!',
    'DELETE_FAILED_USERS' => 'Der Benutzer konnte nicht gelöscht werden!',
    'DELETE_FAILED_USERS_OWN' => 'Du kannst deinen eigenen Account nicht löschen!',
    'DELETE_FAILED_USERS_LAST' => 'Der letzte Benutzer kann nicht gelöscht werden!',
    'DELETE_FAILED_USERSARTICLES' => 'Artikel können nicht zum zu löschenden Benutzer verschoben werden!',
    'DELETE_FAILED_ROLL' => 'Die Benutzerrolle konnte nicht gelöscht werden!',
    'DELETE_FAILED_CATEGORIES' => 'Die Kategorien konnten nicht gelöscht werden!',
    'DELETE_FAILED_NEWTHUMBS' => 'Thumbnails konnten nicht erzeugt werden!<br>{{filenames}}',
    'DELETE_FAILED_FILES' => 'Die Dateien konnten nicht gelöscht werden!<br>{{filenames}}',
    'DELETE_FAILED_FILEAUTHORIMG' => 'Der Avatar konnte nicht gelöscht werden!',
    'DELETE_FAILED_RENAME' => 'Die Datei {{filename1}} konnte nicht  {{filename2}} umbenannt werden!',
    'DELETE_FAILED_SMILEYS' => 'Die Smileys konnten nicht gelöscht werden!',
    'DELETE_FAILED_IPADDRESS' => 'Die IP-Adresse konnten nicht gelöscht werden!',
    'DELETE_FAILED_WORDBAN' => 'Die Begriffe konnten nicht gelöscht werden!',
    'DELETE_FAILED_ARTICLE' => 'Die Artikel konnten nicht gelöscht werden!',
    'DELETE_FAILED_REVISIONS' => 'Die Revisionen konnten nicht gelöscht werden!',
    'DELETE_FAILED_TRASH' => 'Der Papierkorb konnte nicht geleert werden!',
    'DELETE_FAILED_COMMENTS' => 'Die Kommentare konnten nicht gelöscht werden!',
    'LOAD_FAILED_ARTICLE' => 'Der gesuchte Artikel wurde nicht gefunden.',
    'LOAD_FAILED_COMMENT' => 'Der gesuchte Kommentar wurde nicht gefunden.',
    'LOAD_FAILED_COMMENT_ARTICLE' => 'Der zu diesem Kommentar gehörige Artikel wurde nicht gefunden. Der Kommentar muss zu einem anderen Artikel verschoben werden, um im Frontend sichtbar zu sein.',
    'LOAD_FAILED_USER' => 'Der gesuchte Benutzer wurde nicht gefunden.',
    'LOAD_FAILED_ROLL' => 'Die gesuchte Benutzerrolle wurde nicht gefunden.',
    'LOAD_FAILED_CATEGORY' => 'Die gesuchte Kategorie wurde nicht gefunden.',
    'LOAD_FAILED_WORDBAN' => 'Der Begriff wurde nicht gefunden.',
    'UPDATE_VERSIONCHECK_NEW' => 'FanPress CM Version <i>{{version}}</i> ist verfügbar! {{btn}}',
    'UPDATE_VERSIONCHECK_CURRENT' => 'Deine Version von FanPress CM ist <strong>aktuell</strong>!',
    'UPDATE_VERSIONCHECK_NOTES' => 'Release-Notes und weitere Infos zu System- und Modul-Updates findest du in den aktuellen FanPress CM News.',
    'UPDATE_VERSIONCECK_FILEDB_ERR' => 'Die Version im Dateisystem und der Datenbank stimmen nicht überein. {{btn}}',
    'UPDATE_VERSIONCECK_FILETXT_ERR' => 'Die Datei <em>/data/config/files.txt</em> wurde nicht gefunden. Dies sollte nicht passieren und kann zu unvorhergesehenem Verhalten führen.',
    'UPDATE_VERSIONCECK_FILETXT_ERR2' => 'Die Datei /config/files.txt wurde für dieses Modul nicht gefunden. Dies sollte nicht passieren und kann zu unvorhergesehenem Verhalten führen.',
    'UPDATE_NOTAUTOCHECK' => 'Es konnte keine automatische Update-Prüfung durchgeführt werden! {{btn}}',
    'UPDATE_WRITEERROR' => 'Einige Dateien im Dateisystem sind nicht beschreibbar und können daher nicht ersetzt werden. Prüfe die Rechte der Dateien via FTP, eine Liste findest du im System-Log.',
    'PACKAGES_FAILED_DOWNLOAD_UNTRUSTED' => 'Die verfügbare Paketdatei wird nicht heruntergeladen, da dem Paket-Server <em>{{var}}</em> nicht vertraut wird.',
    'PACKAGES_FAILED_ERROR901' => 'Es konnte keine Verbindung zum Paketserver hergestellt werden!',
    'PACKAGES_FAILED_ERROR902' => 'Es konnte keine lokale Paket-Datei erzeugt werden!',
    'PACKAGES_FAILED_ERROR903' => 'Beim Schreiben der lokalen Paket-Datei ist ein Fehler aufgetreten!',
    'PACKAGES_FAILED_ERROR904' => 'Die lokale Paket-Datei wurde nicht gefunden!',
    'PACKAGES_FAILED_ERROR906' => 'Die Archiv-Datei konnte nicht geöffnet werden!',
    'PACKAGES_FAILED_ERROR907' => 'Beim Entpacken der Archiv-Datei ist ein Fehler aufgetreten!',
    'PACKAGES_FAILED_ERROR908' => 'Beim Aktualisieren der lokalen Dateien ist ein Fehler aufgetreten! Weitere Informationen enthält das Paketmanager-Protokoll.',
    'UPDATE_MODULECHECK_NEW' => 'Für einige Module sind Updates verfügbar. {{btn}}',
    'UPDATE_MODULECHECK_CURRENT' => 'Alle installierten Module sind <strong>aktuell</strong>!',
    'UPDATE_MODULECHECK_FAILED' => 'Es konnte keine Update-Prüfung für die installierten Module durchgeführt werden!',
    'PACKAGEMANAGER_SUCCESS' => 'Die Installation des Pakets wurde erfolgreich durchgeführt.',
    'PACKAGEMANAGER_FAILED' => 'Bei der Installation des Pakets ist ein Fehler aufgetreten. Ausführliche Informationen beinhaltet des Fehler-Log.',
    'LOGS_CLEARED_LOG_OK' => 'Das ausgewählte Protokoll wurde geleert.',
    'LOGS_CLEARED_LOG_FAILED' => 'Das ausgewählte Protokoll konnte nicht geleert werden!',
    'MODULES_FAILED_ENABLE' => 'Das ausgewählte Modul konnten nicht aktiviert werden.',
    'MODULES_FAILED_DISABLE' => 'Das ausgewählte Modul konnten nicht deaktiviert werden.',
    'MODULES_FAILED_INSTALL' => 'Das ausgewählte Modul konnte nicht installiert werden.',
    'MODULES_FAILED_UNINSTALL' => 'Das ausgewählte Modul konnte nicht deinstalliert werden.',
    'MODULES_FAILED_DEPENCIES' => 'Es wurden nicht-erfüllte Abhängigkeiten erkannt, dass Modul kann daher nicht installiert werden!',
    'PUBLIC_FAILED_CAPTCHA' => 'Du hast die Captcha-Frage nicht korrekt beantwortet!',
    'PUBLIC_FAILED_NAME' => 'Bitte gibt deinen Namen ein!',
    'PUBLIC_FAILED_EMAIL' => 'Bitte gibt deine E-Mail-Adresse ein!',
    'PUBLIC_FAILED_FLOOD' => 'Bitte warte mindestens {{seconds}} Sekunden, bevor du einen weiteren Kommentar schreibst!',
    'PUBLIC_ARTICLE_PINNED' => 'Dieser Artikel ist gepinnt und wird über allen anderen angezeigt.',
    'PUBLIC_PRIVACY' => 'Du musst unserer Datenschutz-Erklärung zustimmen, um einen Kommentar zu verfassen.',
    'PUBLIC_SHARE_LIKE' => 'Danke für den Like. Wir freuen uns, dass dir der Beitrag gefällt!',
);
?>