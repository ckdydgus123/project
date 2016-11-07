package fiveteam.com.rsms;

import android.util.Log;

import org.altbeacon.beacon.Beacon;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.util.List;

public class contentPost extends Thread {


    private final List<Beacon> jump;


    public contentPost(List<Beacon> jump) {

        this.jump = jump;

        System.out.println("sf"+jump.get(0).getId3());
    }

    public void run(){

        sendParsingDataByHttps();
    }

    public void sendParsingDataByHttps()
    {

        try {

            System.out.println("sf2"+jump.get(0).getId3());

            Log.d("cyka", "들어오냐?");

            String requestURL = "http://107.161.27.109/Home/beaconContect";
            URL url = new URL(requestURL);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();

            if(connection != null) {

                Log.d("cyka", "접속은 되냐?");

                connection.setUseCaches(false);
                connection.setDoInput(true);
                connection.setDoOutput(true);
                connection.setRequestMethod("POST");
                connection.setRequestProperty("content-type", "application/x-www-form-urlencoded");

                StringBuffer stringBuffer = new StringBuffer();



                stringBuffer.append("beaconNum").append("=").append(jump.get(0).getId3()).append("&");
                stringBuffer.append("memberNum").append("=").append(MyFirstPlugin.memeberNum);

                PrintWriter printWriter = new PrintWriter(new OutputStreamWriter(connection.getOutputStream()));
                printWriter.write(stringBuffer.toString());
                printWriter.flush();

                /* flush */
                Log.d("cyka", "푸시끝낫냐?");

                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                StringBuilder  builder        = new StringBuilder();
                String line;

                while((line = bufferedReader.readLine()) != null)
                {
                    Log.d("cyka", "던짓냐?");
                    builder.append(line);
                    Log.d("cyka", "ssss = " + line);
                }

                connection.disconnect();
            }

        } catch(IOException e) {
            Log.d("cyka", "예외처리다");
            e.printStackTrace();
        }
    }

}
