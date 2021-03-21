실행 
laravel env 파일에 맞춰 디비 생성후 

php artisan key:generate

요 부분을 원하는 도메인으로 바꾸면됨
SESSION_DOMAIN=127.0.0.1
SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000,127.0.0.1:3000,127.0.0.1

front : npm install, npm start
TodoList : composer install, php artisan serve

로그아웃 생성
spa인증에 로그아웃에 대한 내용이 없어서 laravel 세션 쿠키 날렸습니다

로깅
라라벨은 로깅을 할 수 있는 다양한 방법이 존재하며 여기서는 슬랙 로깅 사용방법을 써봤는데 아직 슬랙이 크리티컬 이하도 로깅이 되서 고쳐야합니다
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


로그에서 critcal로 설정했는데 슬랙로그가 다른레벨의 것도 찍는것

// 카카오 로그인 부분 
https://socialiteproviders.com/Kakao/ 여기서 컴포저로 카카오 설치 및 설정 잡는것 까지 다 나와있으니 그대로 따라하면 됨


실행 순서
kakao/login -> 동의하고 계속하기 진행 
-> 우리가 설정해준 리다이렉트 경로로 이동 이 안에는 kakao/redirection로 해놨음
->받으면서 author 코드랑 state 받음

엑세스토큰 받는거 남음
/*POST /oauth/token HTTP/1.1
Host: kauth.kakao.com
Content-type: application/x-www-form-urlencoded;charset=utf-8*/
// post지만 겟으로 받아오면 잘받아진다 에러도 그냥 에러가 잡히는게 아니라
//"error_description":"Bad client credentials","error_code":"KOE010" 요 에러 잡히는데 무슨 문제인지는 모르겠다

토큰을 예제에는 토큰을 쿠키에 날려서 저장

결국 폴리시는 api형식에 안맞는다는것을 깨달음 자꾸 이상한쪽으로 에러를띄움
그래서 auth::user()->id로 접근함 task는 고침 user는 시간없어서 못고침 




