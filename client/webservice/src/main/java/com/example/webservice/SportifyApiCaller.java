package com.example.webservice;

import com.example.model.User;
import com.google.gson.Gson;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

/**
 * The type Sportify api caller.
 */
public class SportifyApiCaller {

    private Retrofit retrofit;
    private ISportifyApi sportifyApi;
    private ISportifyApiResponseHandler sportifyApiResponseHandler;
    private String sportifyApiUrl = "http://sportifyair.000webhostapp.com/";
    private Gson gson;

    /**
     * Instantiates a new Sportify api caller.
     *
     * @param sportifyApiResponseHandler the sportify api response handler
     */
    public SportifyApiCaller(ISportifyApiResponseHandler sportifyApiResponseHandler){
        this.sportifyApiResponseHandler = sportifyApiResponseHandler;
        this.gson = new Gson();
        this.retrofit = new Retrofit.Builder()
                .baseUrl(this.sportifyApiUrl)
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        this.sportifyApi = this.retrofit.create(ISportifyApi.class);
    }

    /**
     * Get users.
     */
    public void GetUsers(){
        Call<List<User>> call = this.sportifyApi.getUsers();
        this.requestApiData(call, SportifyApiActions.GetUsers);
    }

    private void requestApiData(Call<List<User>> apiCall, final SportifyApiActions apiAction){
        if(apiCall == null)
            return;

        apiCall.enqueue(new Callback<List<User>>() {
            @Override
            public void onResponse(Call<List<User>> call, Response<List<User>> response) {
                switch (apiAction){
                    case GetUsers:
                        handleGetUsers(response);

                        break;
                }
            }

            @Override
            public void onFailure(Call<List<User>> call, Throwable t) {
                User user = new User();
            }
        });
    }

    private void handleGetUsers(Response<List<User>> response){
        List<User> users = response.body();
        this.sportifyApiResponseHandler.onResponseReceived(users);
    }
}
