package fiveteam.com.rsms;

import android.os.Handler;
import android.os.Message;

public class serverTest extends Thread {

    Handler handler;
    String msg;

    serverTest(Handler handler,String msg) {
        this.handler = handler;
        this.msg = msg;

        System.out.println("cyka213:"+msg);
    }

    public void getParsingDataByHttps() {

        Message tt = new Message();

        tt.what = 0;
        tt.obj = msg;
        handler.sendMessage(tt);
    }

    public void run() {
        getParsingDataByHttps();
    }
}