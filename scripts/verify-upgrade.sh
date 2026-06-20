#!/usr/bin/env bash
# Static verification for OCWMS Laravel 13 upgrade (no PHP required)
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"
FAIL=0

check() {
  if eval "$2"; then
    echo "  OK  $1"
  else
    echo "  FAIL $1"
    FAIL=$((FAIL + 1))
  fi
}

echo "=== OCWMS upgrade verification ==="

echo ""
echo "Core stack"
check "composer.json Laravel 13" "grep -q 'laravel/framework.*13' composer.json"
check "Docker Compose" "test -f docker-compose.yml"
check "CI workflow" "test -f .github/workflows/ci.yml"
check "Models (6)" "[ \"\$(find app/Models -maxdepth 1 -name '*.php' 2>/dev/null | wc -l | tr -d ' ')\" -eq 6 ]"
check "Controllers (4)" "test $(ls app/Http/Controllers/*.php 2>/dev/null | wc -l | tr -d ' ') -eq 4"
check "Middleware (2)" "test $(ls app/Http/Middleware/*.php 2>/dev/null | wc -l | tr -d ' ') -eq 2"

echo ""
echo "Views referenced by controllers"
VIEWS=(
  home
  faculty.home faculty.login faculty.registration faculty.courses faculty.lectures
  faculty.assignments faculty.create_course faculty.create_lecture faculty.create_assignment
  faculty.assignment faculty.course faculty.edit_profile faculty.change_password
  student.home student.login student.registration student.courses student.browse
  student.solution student.course student.edit_profile student.change_password
  emails.auth.registration
  faculty_master student_master
)
for v in $VIEWS; do
  check "view $v" "test -f resources/views/${v//.//}.blade.php"
done

echo ""
echo "Migrations"
for m in courses lectures assignments users_courses students_assignments; do
  check "migration *${m}*" "ls database/migrations/*${m}* 2>/dev/null | grep -q ."
done

echo ""
echo "Tests"
for t in tests/Unit/UserModelTest.php tests/Unit/CourseModelTest.php \
         tests/Feature/HomePageTest.php tests/Feature/FacultyAuthTest.php \
         tests/Feature/StudentAuthTest.php; do
  check "$t" "test -f $t"
done

echo ""
echo "Routes -> controller methods"
for r in showHome processRegistration processLogin processCourse processLecture processAssignment processGrade enrollToCourse processSolution; do
  check "controller method $r" "grep -rq \"function $r\" app/Http/Controllers/"
done
check "route web.php" "test -f routes/web.php"

echo ""
echo "No legacy Sentry/Form helpers in views"
check "views clean" "! rg -q 'Sentry::|Form::|HTML::' resources/views/"

echo ""
if [ "$FAIL" -eq 0 ]; then
  echo "Static checks: ALL PASSED"
  exit 0
else
  echo "Static checks: $FAIL FAILED"
  exit 1
fi
