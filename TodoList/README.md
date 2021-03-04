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
로그인(/login) 하고 127.0.0.1:3000/user에 들어가서 버튼을 누르면 콘솔로 유저목록을 확인 가능함 (grade가 user면 에러띄움)

127.0.0.1:3000/taskInsert로 일반 로그인 유저도 작성 가능하며

127.0.0.1:3000/taskList에서 
listAny는 관리자만 접근하여 모든 task를 가져올 수 있음 
listUser는 본인이 쓴 task만 접근가능

로그아웃 생성
spa인증에 로그아웃에 대한 내용이 없어서 laravel 세션 쿠키 날림

로깅
라라벨은 로깅을 할 수 있는 다양한 방법이 존재하며 여기서는 슬랙 로깅 사용방법을 써봤다
https://www.lesstif.com/php-and-laravel/sending-slack-notifications-from-laravel-36209045.html 슬랙이랑 연동방법 8.0부터는 라라벨을 설치할 때 자동으로 설치가 되있어서 채널과 링크만 넣어주면된다
세팅 

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'syslog', 'slack'], 
            'ignore_exceptions' => false,
        ],

//'channels' => ['single', 'syslog', 'slack'], 내가 사용할 로깅 방법들

사용 예시 Log::notice('create user ', ['userInfo' => $user->toArray()]);  notice는 로그 단계다 이건 문서를 통해 확인가능 

model observer 모델 옵저버는 db에 모델이 삽입 삭제등의 작업이 실행될 때 메서드를 실행 할 수 있게해준다 
public function created(User $user)
{
        Log::notice('create user ', ['userInfo' => $user->toArray()]);
} 예를 들면 이런식으로 유저든 예약관련이든 삽입 삭제를 하면 로그가 찍힌다 




