package com.example.webservice;

import com.example.model.User;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;

/**
 * The interface Sportify api.
 */
public interface ISportifyApi {

    /**
     * Gets users.
     *
     * @return the users
     */
    @GET("server/users/list/")
    Call<List<User>> getUsers();
}
