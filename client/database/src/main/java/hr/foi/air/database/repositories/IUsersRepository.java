package hr.foi.air.database.repositories;


import hr.foi.air.database.entities.User;

/**
 * The interface Users repository.
 */
public interface IUsersRepository {
    User getUserByUsername(String userName);
    void AddUser(User user);
}
