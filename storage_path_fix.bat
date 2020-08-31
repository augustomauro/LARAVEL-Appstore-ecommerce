@echo off
rem ^
Se crea subcarpeta storage\app y se genera el archivo .gitignore

mkdir %~d0%~p0storage\app

type NUL > %~d0%~p0storage\app\.gitignore

rem ^
Se escribe en el archivo
echo * >%~d0%~p0storage\app\.gitignore
echo !public/ >>%~d0%~p0storage\app\.gitignore
echo !.gitignore >>%~d0%~p0storage\app\.gitignore

rem ^
Se crea subcarpeta \storage\framework y se genera el archivo .gitignore

mkdir %~d0%~p0storage\framework

type NUL > %~d0%~p0storage\framework\.gitignore

rem ^
Se escribe en el archivo
echo config.php >%~d0%~p0storage\framework\.gitignore
echo routes.php >>%~d0%~p0storage\framework\.gitignore
echo schedule-* >>%~d0%~p0storage\framework\.gitignore
echo compiled.php >>%~d0%~p0storage\framework\.gitignore
echo services.json >>%~d0%~p0storage\framework\.gitignore
echo events.scanned.php >>%~d0%~p0storage\framework\.gitignore
echo routes.scanned.php >>%~d0%~p0storage\framework\.gitignore
echo down >>%~d0%~p0storage\framework\.gitignore

rem ^
Se crea subcarpeta storage\framework\cache\data y se generan los archivos .gitignore

mkdir %~d0%~p0storage\framework\cache\data

type NUL > %~d0%~p0storage\framework\cache\.gitignore
type NUL > %~d0%~p0storage\framework\cache\data\.gitignore

rem ^
Se escribe en los archivos
echo * >%~d0%~p0storage\framework\cache\.gitignore
echo !data/ >>%~d0%~p0storage\framework\cache\.gitignore
echo !.gitignore >>%~d0%~p0storage\framework\cache\.gitignore

echo * >%~d0%~p0storage\framework\cache\data\.gitignore
echo !.gitignore >>%~d0%~p0storage\framework\cache\data\.gitignore

rem ^
Se crea subcarpeta storage\framework\sessions y se genera el archivo .gitignore

mkdir %~d0%~p0storage\framework\sessions

type NUL > %~d0%~p0storage\framework\sessions\.gitignore

rem ^
Se escribe en el archivo
echo * >%~d0%~p0storage\framework\sessions\.gitignore
echo !.gitignore >>%~d0%~p0storage\framework\sessions\.gitignore

rem ^
Se crea subcarpeta storage\framework\testing y se genera el archivo .gitignore

mkdir %~d0%~p0storage\framework\testing

type NUL > %~d0%~p0storage\framework\testing\.gitignore

rem ^
Se escribe en el archivo
echo * >%~d0%~p0storage\framework\testing\.gitignore
echo !.gitignore >>%~d0%~p0storage\framework\testing\.gitignore

rem ^
Se crea subcarpeta storage\framework\views y se genera el archivo .gitignore

mkdir %~d0%~p0storage\framework\views

type NUL > %~d0%~p0storage\framework\views\.gitignore

rem ^
Se escribe en el archivo
echo * >%~d0%~p0storage\framework\views\.gitignore
echo !.gitignore >>%~d0%~p0storage\framework\views\.gitignore

rem ^
Se crea subcarpeta storage\logs y se genera el archivo .gitignore

mkdir %~d0%~p0storage\logs

type NUL > %~d0%~p0storage\logs\.gitignore

rem ^
Se escribe en el archivo
echo * >%~d0%~p0storage\logs\.gitignore
echo !.gitignore >>%~d0%~p0storage\logs\.gitignore





rem ^
Para editar el archivo creado mediante 'type NUL > Archivo.txt', 
el path de trabajo actual es: echo %~d0%~p0Archivo.txt
@echo off