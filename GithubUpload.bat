@echo off
echo ========================================
echo      SMART AUTO GIT UPLOADER (v12)
echo      (New Branch: jitul Support)
echo ========================================
echo.

:: === STEP 1: Repository Link ===
set /p REPO=Enter your GitHub repository link: 
if "%REPO%"=="" exit /b

:: === STEP 2: Branch Name (Ekhane 'jitul' likhun) ===
set /p BRANCH=Enter branch name (example: jitul): 
if "%BRANCH%"=="" set BRANCH=main

echo.
echo Repository: %REPO%
echo Branch: %BRANCH%
echo.

:: === STEP 3: Initialize & Create/Switch Branch ===
if not exist .git (
    echo 🧱 Initializing new Git repository...
    git init
)

:: (FIX) Notun branch create ba switch korar logic
git checkout %BRANCH% 2>nul || git checkout -b %BRANCH%

git remote add origin %REPO% 2>nul
git remote set-url origin %REPO%

:: === STEP 4: Add and Commit ===
echo ➕ Adding all local changes...
git add .

set /p msg=Enter commit message (default: auto update): 
if "%msg%"=="" set msg=auto update

echo 💬 Committing changes...
git commit --allow-empty -m "%msg%"

:: === STEP 5: Solo/Group Selection ===
echo.
echo ❓ Are you working Solo or in a Group?
echo [1] Solo (Rebase)
echo [2] Group (Merge)
set /p choice=Select [1 or 2] (default 1): 

echo.
echo 📥 Syncing latest changes from GitHub...

if "%choice%"=="2" (
    echo Mode: Group (Merge)
    git pull origin %BRANCH% --no-edit 2>nul
) else (
    echo Mode: Solo (Rebase)
    git pull origin %BRANCH% --rebase 2>nul
)

:: === STEP 6: Push to GitHub ===
echo.
echo 🚀 Uploading code to GitHub...
:: Notun branch prothombari push korle -u origin %BRANCH% proyojon
git push -u origin %BRANCH%

if errorlevel 1 (
    echo.
    echo ❌ Push failed! Check your internet or permissions.
) else (
    echo.
    echo ✅ All done! Code uploaded to branch: %BRANCH%
)

pause