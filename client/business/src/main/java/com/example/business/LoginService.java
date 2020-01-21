package com.example.business;

import hr.foi.air.database.entities.User;
import hr.foi.air.database.repositories.IUsersRepository;

/**
 * The type Login service.
 */
public class LoginService implements ILoginService {

    private IUsersRepository usersRepository;

    /**
     * Instantiates a new Login service.
     *
     * @param usersRepository the users repository
     */
    public LoginService(IUsersRepository usersRepository) {
        this.usersRepository = usersRepository;
    }

    public boolean LoginUser(String username, String password){
        User user = this.usersRepository.getUserByUsername(username);

        if(user == null)
            return false;

        if(password.equals(user.getPassword()))
            return true;

        return false;
    }
}
