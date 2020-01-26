package hr.foi.air.database.repositories;

import java.util.ArrayList;
import java.util.List;

import hr.foi.air.database.entities.User;

/**
 * The type Users repository.
 */
public class UsersRepository implements IUsersRepository {

    /**
     * Get users list.
     *
     * @return the list
     */
    public List<User> GetUsers(){
        User user1 = new User();
        user1.setUsername("mario.pejic");

        User user2 = new User();
        user2.setUsername("kreso.beljak");

        List<User> users = new ArrayList<User>();
        users.add(user1);
        users.add(user2);

        return users;
    }

    public User getUserByUsername(String userName){
        User user = new User();
        user.setUsername(userName);
        user.setPassword("password123");

        return user;
    }

    public void AddUser(User user){

    }
}
