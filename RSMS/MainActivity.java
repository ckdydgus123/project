package fiveteam.com.rsms;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.os.RemoteException;
import android.text.TextUtils;
import android.util.Log;
import android.webkit.JavascriptInterface;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.EditText;
import android.widget.Toast;

import org.altbeacon.beacon.Beacon;
import org.altbeacon.beacon.BeaconConsumer;
import org.altbeacon.beacon.BeaconManager;
import org.altbeacon.beacon.BeaconParser;
import org.altbeacon.beacon.RangeNotifier;
import org.altbeacon.beacon.Region;
import org.apache.cordova.*;
import org.json.JSONException;
import org.json.JSONObject;

import com.github.nkzawa.emitter.Emitter;
import com.github.nkzawa.socketio.client.IO;
import com.github.nkzawa.socketio.client.Socket;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.messaging.FirebaseMessaging;

import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.Collection;
import java.util.List;


public class MainActivity extends CordovaActivity implements BeaconConsumer {
    private BeaconManager beaconManager;

    // 감지된 비콘들을 임시로 담을 리스트
    private List<Beacon> beaconList = new ArrayList<>();
    private List<Beacon> jump = new ArrayList<>();
    boolean flag = true;

   // private final Handler handler = new Handler();

    private Socket socket;

    {
        try {
            socket = IO.socket("http://107.161.27.109:3000");
        } catch (URISyntaxException e) {
            throw new RuntimeException(e);
        }
    }

    @SuppressLint({"SetJavaScriptEnabled", "JavascriptInterface"})
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        beaconStart();

        System.out.println("token : " + FirebaseInstanceId.getInstance().getToken());


        //socket.on("sibal", onAuthenticate);

        launchUrl = "file:///android_asset/www/index.html";
        loadUrl(launchUrl);
    }
/*

    private class AndroidBridge {
        public void testMove(final String arg) { // must be final
            handler.post(new Runnable() {
                @Override
                public void run() {
                    // 원하는 동작
                    mWebView.loadUrl(arg);
                }
            });
        }
    }
*/

/*    private Emitter.Listener onLogin = new Emitter.Listener() {
        @Override
        public void call(Object... args) {
            JSONObject data = (JSONObject) args[0];

            int numUsers;
            try {
                numUsers = data.getInt("numUsers");
            } catch (JSONException e) {
                return;
            }

            Intent intent = new Intent();
            intent.putExtra("username", mUsername);
            intent.putExtra("numUsers", numUsers);
            setResult(RESULT_OK, intent);
            finish();
        }
    };*/

    private Emitter.Listener onAuthenticate = new Emitter.Listener() {
        @Override
        public void call(final Object... args) {
            MainActivity.this.runOnUiThread(new Runnable() {
                @Override
                public void run() {

                    System.out.println("라라라");


                }
            });
        }
    };

    //비콘 시작 함수
    public void beaconStart() {

        beaconManager = BeaconManager.getInstanceForApplication(this);
        // 여기가 중요, 기기에 따라서 setBeaconLayout 안의 내용 변경
        beaconManager.getBeaconParsers().add(new BeaconParser().
                setBeaconLayout("m:2-3=0215,i:4-19,i:20-21,i:22-23,p:24-24,d:25-25"));

        // 비콘 탐지를 시작한다. 실제로는 서비스를 시작하는것.
        beaconManager.bind(this);

    }

    @Override
    public void onBeaconServiceConnect() {
        System.out.println("비콘 실행1");

        beaconManager.setRangeNotifier(new RangeNotifier() {

            @Override
            // 비콘이 감지되면 해당 함수가 호출된다. Collection<Beacon> beacons에는 감지된 비콘의 리스트가,
            // region에는 비콘들에 대응하는 Region 객체가 들어온다.
            public void didRangeBeaconsInRegion(Collection<Beacon> beacons, Region region) {

                System.out.println("비콘 실행2");

                if (beacons.size() > 0) {
                    beaconList.clear();
                    for (Beacon beacon : beacons) {

                        socket.connect();



                        //비콘 거리측정 판단 변수
                        int beaconRssi = beacon.getRssi() + 100;

                        System.out.println("now4 : : :" + beacon.getId3()+ "///" + beaconRssi);

                        //비콘과의 거리가 -50 이하일 경우
                        if (beaconRssi >= 50 && beaconRssi <= 60) {

                            beaconList.add(beacon);
                            System.out.println("check0-1 : " +  beaconList.get(0).getId3() );

                            System.out.println("now5 : : : " + beacon.getId3()+  beaconRssi);

                            //첫 반응일 경우
                            if (flag == true) {
                                System.out.println("beacon connect");

                                //비콘 connect시 node를 이용해서 서버로 전송
                                JSONObject jsonObject = new JSONObject();//json 객체 생성
                                try {

                                    // 모바일 기기 token 값 색출
                                    String token = FirebaseInstanceId.getInstance().getToken();
                                    jsonObject.put("token", token);//모바일 기기 token값
                                    jsonObject.put("beaconNum", beacon.getId3());//비콘 고유값

                                    //node 서버로 전송
                                    socket.emit("fromandroid", jsonObject);


                                } catch (JSONException e) {

                                    Log.d("JSONException", e.getMessage());
                                }

                                System.out.println("Test반응-2");

                                // 첫번째 값 저장
                                jump.add(beacon);
                                System.out.println("check0-4 : " + jump.get(0).getId3());
                                flag = false;

                                Message msg = new Message();
                                msg.what = 0;
                                msg.obj = "백화점 입구 추천";
                                handler.sendMessage(msg);


                                System.out.println("check1 : " + (flag == false));
                                System.out.println("check2 : " + (beaconList.get(0).getId3().equals(jump.get(0).getId3())));
                                System.out.println("check2-1 : " + beaconList.get(0).getId3());
                                System.out.println("check2-2 : " + jump.get(0).getId3());
                                System.out.println("check3 : " + (beaconRssi >= 45 && beaconRssi <= 60));

                                System.out.println("check4 : " + (flag == false && (beaconList.get(0).getId3().equals(jump.get(0).getId3())) && (beaconRssi >= 45 && beaconRssi <= 60)));

                                // 두번째 반응 부터  비콘 첫번째 반응과 동일하면
                            } else if (flag == false && (beaconList.get(0).getId3().equals(jump.get(0).getId3())) && (beaconRssi >= 50 && beaconRssi <= 60)) {


                                System.out.println("동일 : " +beaconList.get(0).getId3()+"//"+jump.get(0).getId3() );

                                System.out.println("Test반응-3");

                                // 두번째 반응 부터 비콘 그전 반응과 다르면
                            } else if (flag == false && !(beaconList.get(0).getId3().equals(jump.get(0).getId3())) && (beaconRssi >= 50 && beaconRssi <= 60 )) {


                                //비콘 connect시 node를 이용해서 서버로 전송
                                JSONObject jsonObject = new JSONObject();//json 객체 생성
                                try {

                                    // 모바일 기기 token 값 색출
                                    String token = FirebaseInstanceId.getInstance().getToken();
                                    jsonObject.put("token", token);//모바일 기기 token값
                                    jsonObject.put("beaconNum", beacon.getId3());//비콘 고유값

                                    //node 서버로 전송
                                    socket.emit("fromandroid", jsonObject);


                                } catch (JSONException e) {

                                    Log.d("JSONException", e.getMessage());
                                }


                                System.out.println("동일2 : " +beaconList.get(0).getId3()+"//"+jump.get(0).getId3() );

                                System.out.println("Test반응-4");


                                // 첫 값지우고
                                jump.clear();
                                // 다시 추가
                                jump.add(beaconList.get(0));

                                Message msg = new Message();
                                msg.what = 1;
                                msg.obj = "매장 입구 추천";
                                handler.sendMessage(msg);


                                System.out.println("ss5:" + jump.get(0).getId3());
                            }
                        }



/*
                        //비콘과의 거리가 -50 이하일 경우
                        if (beaconRssi >= 38 && beaconRssi <= 60) {

                            beaconList.add(beacon);
                            System.out.println("check0-1 : " +  beaconList.get(0).getId3() );

                            System.out.println("now5 : : : " + beacon.getId3()+  beaconRssi);

                            //첫 반응일 경우
                            if (flag == true) {
                                System.out.println("beacon connect");

                                    *//*비콘 connect시 node를 이용해서 서버로 전송*//*
                                JSONObject jsonObject = new JSONObject();//json 객체 생성
                                try {

                                    // 모바일 기기 token 값 색출
                                    String token = FirebaseInstanceId.getInstance().getToken();
                                    jsonObject.put("token", token);//모바일 기기 token값
                                    jsonObject.put("beaconNum", beacon.getId3());//비콘 고유값

                                    //node 서버로 전송
                                    socket.emit("fromandroid", jsonObject);


                                } catch (JSONException e) {

                                    Log.d("JSONException", e.getMessage());
                                }

                                System.out.println("Test반응-2");

                                // 첫번째 값 저장
                                jump.add(beacon);
                                System.out.println("check0-4 : " + jump.get(0).getId3());
                                flag = false;

                                Message msg = new Message();
                                msg.what = 0;
                                msg.obj = "백화점 입구 추천";
                                handler.sendMessage(msg);


                                System.out.println("check1 : " + (flag == false));
                                System.out.println("check2 : " + (beaconList.get(0).getId3().equals(jump.get(0).getId3())));
                                System.out.println("check2-1 : " + beaconList.get(0).getId3());
                                System.out.println("check2-2 : " + jump.get(0).getId3());
                                System.out.println("check3 : " + (beaconRssi >= 45 && beaconRssi <= 60));

                                System.out.println("check4 : " + (flag == false && (beaconList.get(0).getId3().equals(jump.get(0).getId3())) && (beaconRssi >= 45 && beaconRssi <= 60)));

                                // 두번째 반응 부터  비콘 첫번째 반응과 동일하면
                            } else if (flag == false && (beaconList.get(0).getId3().equals(jump.get(0).getId3())) && (beaconRssi >= 38 && beaconRssi <= 60)) {


                                System.out.println("동일 : " +beaconList.get(0).getId3()+"//"+jump.get(0).getId3() );

                                System.out.println("Test반응-3");

                                // 두번째 반응 부터 비콘 그전 반응과 다르면
                            } else if (flag == false && !(beaconList.get(0).getId3().equals(jump.get(0).getId3())) && (beaconRssi >= 38 && beaconRssi <= 60 )) {


                                      *//*비콘 connect시 node를 이용해서 서버로 전송*//*
                                JSONObject jsonObject = new JSONObject();//json 객체 생성
                                try {

                                    // 모바일 기기 token 값 색출
                                    String token = FirebaseInstanceId.getInstance().getToken();
                                    jsonObject.put("token", token);//모바일 기기 token값
                                    jsonObject.put("beaconNum", beacon.getId3());//비콘 고유값

                                    //node 서버로 전송
                                    socket.emit("fromandroid", jsonObject);


                                } catch (JSONException e) {

                                    Log.d("JSONException", e.getMessage());
                                }


                                System.out.println("동일2 : " +beaconList.get(0).getId3()+"//"+jump.get(0).getId3() );

                                System.out.println("Test반응-4");


                                // 첫 값지우고
                                jump.clear();
                                // 다시 추가
                                jump.add(beaconList.get(0));

                                Message msg = new Message();
                                msg.what = 1;
                                msg.obj = "매장 입구 추천";
                                handler.sendMessage(msg);


                                System.out.println("ss5:" + jump.get(0).getId3());
                            }
                        }
                        */
                    }
                }
            }
        });

        try {
            beaconManager.startRangingBeaconsInRegion(new Region("myRangingUniqueId", null, null, null));
        } catch (RemoteException e) {
        }
    }

    // 백화점 입구 비콘과 반응 했을때의 알림창
    public Handler handler = new Handler() {
        @Override
        public void handleMessage(Message msg) {

            if (msg.what == 0) {   //백화점 방문 시
                final CharSequence[] PhoneModels = {"商品/売場推薦", "取消し "};
                AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);     // 여기서 this는 Activity의 this

                // 여기서 부터는 알림창의 속성 설정

                builder.setTitle("こんにちは")// 제목 설정
                        .setSingleChoiceItems(PhoneModels, -1, new DialogInterface.OnClickListener() {

                            public void onClick(DialogInterface dialog, int item) {

                                launchUrl = "file:///android_asset/www/memberInfo2.html";
                                loadUrl(launchUrl);

                                Toast.makeText(getApplicationContext(), "" + PhoneModels[item], Toast.LENGTH_SHORT).show();
                                dialog.cancel();
                            }
                        });/*
                        .setCancelable(false)        // 뒤로 버튼 클릭시 취소 가능 설정
                        .setPositiveButton("확인", new DialogInterface.OnClickListener(){
                            // 확인 버튼 클릭시 설정
                            public void onClick(DialogInterface dialog, int whichButton){

                            }
                        })
                        .setNegativeButton("취소", new DialogInterface.OnClickListener(){
                            // 취소 버튼 클릭시 설정
                            public void onClick(DialogInterface dialog, int whichButton){
                                dialog.cancel();
                            }
                        });*/

                AlertDialog dialog = builder.create();    // 알림창 객체 생성
                dialog.show();    // 알림창 띄우기

            } else if (msg.what == 1) {                   //매장 방문 시 추천화면
                final CharSequence[] PhoneModels = {"商品推薦", "取消し"};
                AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);     // 여기서 this는 Activity의 this

                // 여기서 부터는 알림창의 속성 설정

                builder.setTitle("ベネトンに店へようこそ.")// 제목 설정
                        .setSingleChoiceItems(PhoneModels, -1, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int item) {
                                launchUrl = "file:///android_asset/www/ranking2.html";
                                loadUrl(launchUrl);

                                Toast.makeText(getApplicationContext(), "" + PhoneModels[item], Toast.LENGTH_SHORT).show();
                                dialog.cancel();
                            }
                        });/*
                        .setCancelable(false)        // 뒤로 버튼 클릭시 취소 가능 설정
                        .setPositiveButton("확인", new DialogInterface.OnClickListener(){
                            // 확인 버튼 클릭시 설정
                            public void onClick(DialogInterface dialog, int whichButton){

                            }
                        })
                        .setNegativeButton("취소", new DialogInterface.OnClickListener(){
                            // 취소 버튼 클릭시 설정
                            public void onClick(DialogInterface dialog, int whichButton){
                                dialog.cancel();
                            }
                        });*/

                AlertDialog dialog = builder.create();    // 알림창 객체 생성
                dialog.show();    // 알림창 띄우기
            }
        }
    };


    private class AndroidBridge {

        @JavascriptInterface
        public void setMessage(final String arg) {


            handler.post(new Runnable() {

                public void run() {
                    System.out.println("ccc: " + arg);

                    handler.sendEmptyMessage(0);

                }

            });
        }
    }

    @Override
    public void onDestroy() {
        super.onDestroy();

        beaconManager.unbind(this);
    }

}
