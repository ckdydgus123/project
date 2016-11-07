package fiveteam.com.rsms;

import android.app.AlertDialog;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Handler;
import android.os.Message;
import android.support.v4.app.NotificationCompat;
import android.util.Log;

import com.google.firebase.messaging.RemoteMessage;

import java.util.Map;

/**
 * Created by bon200-29 on 2016-06-13.
 */
public class FirebaseMessagingService extends com.google.firebase.messaging.FirebaseMessagingService {

public void onMessageReceived(RemoteMessage remoteMessage) {

        String from = remoteMessage.getFrom();
        Map<String, String> data = remoteMessage.getData();
        String msg = data.get("message");

        MyFirstPlugin.msg = msg;
        System.out.println("Fire Token :" + msg);

        Log.d("cyka","zzzzz"+MyFirstPlugin.msg);

        showNotification(remoteMessage.getData().get("message"));

        }

private void showNotification(String message) {

        Intent i = new Intent(this,MainActivity.class);
        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

        PendingIntent pendingIntent = PendingIntent.getActivity(this,0,i,PendingIntent.FLAG_UPDATE_CURRENT);

        NotificationCompat.Builder builder = new NotificationCompat.Builder(this)
        .setAutoCancel(true)
        .setContentTitle("공지사항")
        .setContentText(message)
        .setSmallIcon(R.drawable.common_google_signin_btn_icon_dark)
        .setContentIntent(pendingIntent)
        ;


        NotificationManager manager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);

        manager.notify(0,builder.build());

        }


        }
