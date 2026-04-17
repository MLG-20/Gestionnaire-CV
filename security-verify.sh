#!/bin/bash
# Security Verification Script - Gestion-CV
# Run this before production deployment

echo "🔐 Gestion-CV Security Verification Script"
echo "=========================================="
echo ""

ERRORS=0
WARNINGS=0

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to check if file contains string
check_file_contains() {
    local file=$1
    local pattern=$2
    local description=$3
    
    if grep -q "$pattern" "$file" 2>/dev/null; then
        echo -e "${GREEN}✓${NC} $description"
        return 0
    else
        echo -e "${RED}✗${NC} $description"
        ((ERRORS++))
        return 1
    fi
}

# Function to check if file NOT contains string (inverse check)
check_file_not_contains() {
    local file=$1
    local pattern=$2
    local description=$3
    
    if ! grep -q "$pattern" "$file" 2>/dev/null; then
        echo -e "${GREEN}✓${NC} $description"
        return 0
    else
        echo -e "${RED}✗${NC} $description"
        ((ERRORS++))
        return 1
    fi
}

echo "📋 CRITICAL CHECKS"
echo "---"

# Check 1: APP_DEBUG false
check_file_not_contains ".env.example" "APP_DEBUG=true" "APP_DEBUG is not set to true"

# Check 2: SESSION_ENCRYPT true
check_file_contains ".env.example" "SESSION_ENCRYPT=true" "SESSION_ENCRYPT is set to true"

# Check 3: File upload uses WebP
check_file_contains "app/Http/Controllers/ProfileController.php" "toWebp" "File upload forces WebP conversion"

# Check 4: Rate limiting on CV download
check_file_contains "routes/web.php" "throttle:10,3600" "CV download has rate limiting"

# Check 5: Session secure flags
check_file_contains "config/session.php" "httponly" "Session has httponly flag"
check_file_contains "config/session.php" "same_site" "Session has same_site flag"

# Check 6: noSandbox removed
check_file_not_contains "app/Http/Controllers/CvController.php" "noSandbox" "Browsershot sandbox is not disabled"

# Check 7: Color whitelist instead of regex
check_file_contains "app/Http/Controllers/CvController.php" "allowedColors" "Template colors use whitelist"

# Check 8: CSP strict
check_file_not_contains "app/Http/Middleware/SecurityHeaders.php" "img-src 'self' data: https:" "CSP is strict (no https: wildcard)"

# Check 9: Error messages not verbose
check_file_not_contains "app/Http/Controllers/CvController.php" "getMessage()" "Error messages not verbose"

# Check 10: Audit logging
check_file_contains "app/Http/Controllers/ProfileController.php" "Log::" "Audit logging is enabled"

echo ""
echo "📋 CONFIGURATION CHECKS"
echo "---"

if [ -f "config/cors.php" ]; then
    echo -e "${GREEN}✓${NC} CORS configuration exists"
    check_file_not_contains "config/cors.php" "'*'" "CORS is not set to allow all"
else
    echo -e "${RED}✗${NC} CORS configuration missing"
    ((ERRORS++))
fi

if [ -f "nginx-production.conf" ]; then
    echo -e "${GREEN}✓${NC} Nginx production configuration exists"
else
    echo -e "${RED}✗${NC} Nginx production configuration missing"
    ((WARNINGS++))
fi

if [ -f "public/storage/.htaccess" ]; then
    echo -e "${GREEN}✓${NC} Storage .htaccess security file exists"
else
    echo -e "${RED}✗${NC} Storage .htaccess missing"
    ((WARNINGS++))
fi

echo ""
echo "📋 PHP CHECKS"
echo "---"

# Check PHP extensions
PHP_REQUIRED_EXTS=("gd" "mbstring" "xml" "json" "pdo" "bcmath" "zip")

for ext in "${PHP_REQUIRED_EXTS[@]}"; do
    if php -m | grep -q "^$ext\$"; then
        echo -e "${GREEN}✓${NC} PHP extension '$ext' is installed"
    else
        echo -e "${RED}✗${NC} PHP extension '$ext' is MISSING"
        ((ERRORS++))
    fi
done

echo ""
echo "📋 ENVIRONMENT CHECKS"
echo "---"

# Check .env.production file
if [ -f ".env.production" ]; then
    echo -e "${GREEN}✓${NC} .env.production exists"
    check_file_contains ".env.production" "APP_ENV=production" "APP_ENV=production in .env.production"
    check_file_contains ".env.production" "APP_DEBUG=false" "APP_DEBUG=false in .env.production"
else
    echo -e "${YELLOW}⚠${NC} .env.production does not exist (create for production)"
    ((WARNINGS++))
fi

echo ""
echo "=========================================="
echo ""

if [ $ERRORS -eq 0 ]; then
    echo -e "${GREEN}✓ All critical checks passed!${NC}"
    if [ $WARNINGS -gt 0 ]; then
        echo -e "${YELLOW}⚠ $WARNINGS warnings found (see above)${NC}"
    fi
    exit 0
else
    echo -e "${RED}✗ $ERRORS critical issues found (see above)${NC}"
    exit 1
fi
