package com.example.webservice;

/**
 * The interface Sportify api response handler.
 */
public interface ISportifyApiResponseHandler {
    /**
     * On response received.
     *
     * @param response the response
     */
    void onResponseReceived(Object response);
}
