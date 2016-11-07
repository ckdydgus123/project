package fiveteam.com.rsms;

import org.apache.cordova.CordovaPlugin;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.util.Log;
import android.widget.Toast;
import com.google.firebase.iid.FirebaseInstanceId;
import org.apache.cordova.CallbackContext;
import org.apache.cordova.CordovaInterface;
import org.apache.cordova.CordovaWebView;
import org.apache.cordova.PluginResult;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;


public class MyFirstPlugin extends CordovaPlugin {

    private final String ACTION_ECHO = "echo";
    private final String ACTION_GET_MESSAGE = "getMessage";
    private final String ACTION_RUN_JAVASCRIPT_FUNCTION = "runJavasScriptFunction";

    public static final String TAG = "Cool Plugin";
    public static String token;

    public static String msg;
    public static int memeberNum;

    public MyFirstPlugin() {}


    public void initialize(CordovaInterface cordova, CordovaWebView webView) {
        super.initialize(cordova, webView);
        Log.v(TAG,"Init CoolPlugin");
    }

    public boolean execute(final String action, JSONArray args, CallbackContext callbackContext) throws JSONException {

        Context context = this.cordova.getActivity().getApplicationContext();

        token = FirebaseInstanceId.getInstance().getToken();

        System.out.println("action : "+ action +"args : " + args +"callback : " +callbackContext);
        System.out.println("token : " +token);


        final int duration = Toast.LENGTH_SHORT;

        if (action.equals(ACTION_ECHO)) {

            System.out.println("echo 안");

            String message = args.getString(0);

            this.echo(message, callbackContext);
            return true;

        } else if (action.equals(ACTION_GET_MESSAGE)){
            this.getMessage(callbackContext);
        } else if (action.equals(ACTION_RUN_JAVASCRIPT_FUNCTION)){
            String functionName = args.getString(0);
            //this.runJavaScriptFunction(functionName, callbackContext);
        }


        cordova.getActivity().runOnUiThread(new Runnable() {
            public void run() {

                System.out.println("run 안");

                //Toast toast = Toast.makeText(cordova.getActivity().getApplicationContext(), action, duration);
               // toast.show();
            }
        });

        return true;
    }

    private void echo(String message, CallbackContext callbackContext) {
        if (message != null && message.length() > 0) {

            AlertDialog.Builder builder = new AlertDialog.Builder(this.cordova.getActivity());
            builder.setMessage(message).setPositiveButton("확인", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialogInterface, int i) {

                }
            });

            AlertDialog dialog = builder.create();
            dialog.show();

            callbackContext.sendPluginResult(new PluginResult(PluginResult.Status.OK, message));
            callbackContext.success(message);
        } else {
            callbackContext.sendPluginResult(new PluginResult(PluginResult.Status.ERROR, "Expected one non-empty string argument."));
            callbackContext.error("Expected one non-empty string argument.");
        }
    }
    private void getMessage(CallbackContext callbackContext) throws JSONException {
        JSONObject jsonObject = new JSONObject();
        jsonObject.put("name", msg);
        callbackContext.sendPluginResult(new PluginResult(PluginResult.Status.OK, jsonObject));
    }

}

