package br.app.keyar;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.KeyEvent;
import android.webkit.WebSettings;
import android.webkit.WebView;

public class MainActivity extends AppCompatActivity {

    private WebView webView;
    @SuppressLint("SetJavaScriptEnabled")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        // Carregando a tela
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Instanciando a WebView
        webView = (WebView) findViewById(R.id.webview);

        // Setando na WebView, uma espécie de "Browser" interno
        // Isso serve para evitar a necessidade de um navegador no aparelho.
        WebViewKeyar webViewKeyar;
        webViewKeyar = new WebViewKeyar(this);
        webView.setWebViewClient(webViewKeyar);

        // Carregando a URL
        webView.loadUrl("https://www.guilhermedouglas.com");

        //Habilitando o JavaScript
        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);
    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        // Se na Webview, o usuário pressionar o botão de voltar, volta uma página do histórico
        if ((keyCode == KeyEvent.KEYCODE_BACK) && webView.canGoBack()) {
            webView.goBack();
            return true;
        }
        return super.onKeyDown(keyCode, event);
    }
}