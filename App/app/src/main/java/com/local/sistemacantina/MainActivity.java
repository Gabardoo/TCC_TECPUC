package com.local.sistemacantina;

import androidx.appcompat.app.AppCompatActivity;
import com.local.sistemacantina.R;

import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class MainActivity extends AppCompatActivity {

    private WebView myWebView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        myWebView = (WebView) findViewById(R.id.webview);
        myWebView.loadUrl("https://www.google.com.br");
        WebSettings webSettings = myWebView.getSettings();
        //Habilitando o JavaScript
        webSettings.setJavaScriptEnabled(true);
    }
}
