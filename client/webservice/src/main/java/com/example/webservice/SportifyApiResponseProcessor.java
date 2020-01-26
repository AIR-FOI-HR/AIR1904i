package com.example.webservice;

import com.google.gson.Gson;

public class SportifyApiResponseProcessor {
    private ISportifyApiResponseHandler sportifyApiResponseHandler;
    private Gson gson;

    public SportifyApiResponseProcessor(ISportifyApiResponseHandler sportifyApiResponseHandler){
        this.sportifyApiResponseHandler = sportifyApiResponseHandler;
        this.gson = new Gson();
    }
}
