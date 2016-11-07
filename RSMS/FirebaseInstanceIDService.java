package fiveteam.com.rsms;

import android.util.Log;

import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.FirebaseInstanceIdService;
/*
import okhttp3.FormBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;*/

/**
 * Created by bon200-29 on 2016-06-13.
 */
public class FirebaseInstanceIDService extends FirebaseInstanceIdService {

        public void onTokenRefresh() {
            String token = FirebaseInstanceId.getInstance().getToken();

            Log.d("cyka", token);
            /*registerToken(token);*/

            Log.d("cyka", "ttttttttttt");
        }

 /*   private void registerToken(String token) {
    Log.d("cyka", "tttt");

    try {
        String requestURL = "http://107.161.27.109/Home/token?Token="+token;

        Log.d("cyka", requestURL);

        URL url = new URL(requestURL);
        HttpURLConnection conn = (HttpURLConnection)url.openConnection();

    } catch (Exception e) {
        Log.d("cyka","Server Request failed");
    }
}*/

}
