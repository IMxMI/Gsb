$date = Get-Date
$fileName = "C:\Users\maxim\OneDrive\Documents\GitHub\Gsb\resources\bdd\gsb_frais_" + $date.Year + $date.Month +$date.Day + $date.Hour +$date.Minute + ".sql"
C:\wamp64\bin\mariadb\mariadb11.2.2\bin\mysqldump.exe -u root gsb_frais --result-file=$fileName