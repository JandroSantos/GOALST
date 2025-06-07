@echo off
title GOAL.ST - Instalador
echo ===============================
echo   INICIANDO PROYECTO GOAL.ST
echo ===============================

:: Paso 1: Inicializar proyecto si no existe package.json
if not exist package.json (
    echo Inicializando proyecto...
    call npm init -y
)

:: Paso 2: Instalar dependencias
echo Instalando dependencias...
call npm install mysql2
call npm rebuild better-sqlite3

:: Paso 3: Ejecutar el script de base de datos
echo Ejecutando baseDatos.js...
call node baseDatos.js
if %errorlevel% neq 0 (
    echo ❌ Error en baseDatos.js. Revisa el código.
    pause
    exit /b
)

:: Paso 4: Iniciar el servidor en una nueva terminal (cmd separado)
echo Iniciando servidor de chat en el puerto 3000...
start "Servidor de Chat" cmd /k "cd paginas\chat-server && node server.js"

echo ===============================
echo ✅ Todo listo. Chat iniciado.
echo ===============================
pause
