package com.example.business;

import hr.foi.air.database.entities.User;
import hr.foi.air.database.repositories.IUsersRepository;

/**
 * The type Registration service.
 */
public class RegistrationService implements IRegistrationService {
    private IUsersRepository usersRepository;

    /**
     * Instantiates a new Registration service.
     *
     * @param usersRepository the users repository
     */
    public RegistrationService(IUsersRepository usersRepository){
        this.usersRepository = usersRepository;
    }

    /**
     * Register user boolean.
     *
     * @param user the user
     * @return the boolean
     */
    public boolean RegisterUser(User user){
        User existingUser = this.usersRepository.getUserByUsername(user.getUsername());

        if(existingUser != null)
            return false;

        this.usersRepository.AddUser(user);

        return true;
    }
}
