taskkill /F /IM Helper.exe
TIMEOUT /T 5
del Helper.exe
ren _Helper.exe Helper.exe
start "title" "Helper.exe"