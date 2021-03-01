실행 
laravel env 파일에 맞춰 디비 생성후 

요 부분을 원하는 도메인으로 바꾸면됨
SESSION_DOMAIN=127.0.0.1
SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000,127.0.0.1:3000,127.0.0.1

front : npm install, npm start
TodoList : composer install, php artisan serve

create 와 read만 구현했습니다 (나머지는 맞춰서 구현하면됨)
admin 권한으로 접근하는 것을 보고싶으면 일단 127.0.0.1:3000/register로 생성시킨다음
db에서 users테이블에서 grade를 user-> admin으로 바꾸어주고 
로그인 하고 127.0.0.1:3000/user에 들어가서 버튼을 누르면 콘솔로 유저목록을 확인 가능함 (grade가 user면 에러띄울꺼임)

127.0.0.1:3000/taskInsert로 일반 로그인 유저도 작성 가능하며

127.0.0.1:3000/taskList에서 
listAny는 관리자만 접근하여 모든 task를 가져올 수 있음 
listUser는 본인이 쓴 task만 접근가능
