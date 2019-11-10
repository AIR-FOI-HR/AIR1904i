package hr.foi.air.database;

import androidx.room.Dao;
import androidx.room.Delete;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import java.util.List;

import hr.foi.air.database.entities.EventApplication;
import hr.foi.air.database.entities.Chat;
import hr.foi.air.database.entities.Event;
import hr.foi.air.database.entities.Message;
import hr.foi.air.database.entities.Participation;
import hr.foi.air.database.entities.Setting;
import hr.foi.air.database.entities.Sport;
import hr.foi.air.database.entities.User;

@Dao
public interface DAO {
    @Insert public void insertUsers(User... users);
    @Update public void updateUsers(User... users);
    @Delete public void deleteUsers(User... users);
    @Query("SELECT * FROM users") public List<User> loadAllUsers();
    @Query("SELECT * FROM users WHERE id=:id") public User loadUserById(int id);

    @Insert public void insertSports(Sport... sports);
    @Update public void updateSports(Sport... sports);
    @Delete public void deleteSports(Sport... sports);
    @Query("SELECT * FROM sports") public List<Sport> loadAllSports();
    @Query("SELECT * FROM sports WHERE id=:id") public Sport loadSportById(int id);

    @Insert public void insertSettings(Setting... settings);
    @Update public void updateSettings(Setting... settings);
    @Delete public void deleteSettings(Setting... settings);
    @Query("SELECT * FROM settings") public List<Setting> loadAllSettings();
    @Query("SELECT * FROM settings WHERE user_id=:userId") public List<Setting> loadSettingsByUser(int userId);
    @Query("SELECT * FROM settings WHERE id=:id") public Setting loadSettingById(int id);

    @Insert public void insertEventApplications(EventApplication... pendingParticipants);
    @Update public void updateEventApplications(EventApplication... pendingParticipants);
    @Delete public void deleteEventApplications(EventApplication... pendingParticipants);
    @Query("SELECT * FROM applications WHERE player_id=:playerId") public List<EventApplication> loadEventApplicationsByUser(int playerId);
    @Query("SELECT * FROM applications WHERE event_id=:eventId") public List<EventApplication> loadEventApplicationsByEvent(int eventId);


    @Insert public void insertParticipations(Participation... participants);
    @Update public void updateParticipations(Participation... participants);
    @Delete public void deleteParticipations(Participation... participants);
    @Query("SELECT * FROM participations WHERE player_id=:playerId") public List<Participation> loadParticipationsByUser(int playerId);
    @Query("SELECT * FROM participations WHERE event_id=:eventId") public List<Participation> loadParticipationsByEvent(int eventId);

    @Insert public void insertMessages(Message... messages);
    @Update public void updateMessages(Message... messages);
    @Delete public void deleteMessages(Message... messages);
    @Query("SELECT * FROM messages") public List<Message> loadAllMessages();
    @Query("SELECT * FROM messages WHERE sender_id=:userId") public List<Message> loadMessagesBySender(int userId);
    @Query("SELECT * FROM messages WHERE chat_id=:chatId") public List<Message> loadMessagesByChat(int chatId);

    @Insert public void insertEvents(Event... events);
    @Update public void updateEvents(Event... events);
    @Delete public void deleteEvents(Event... events);
    @Query("SELECT * FROM events") public List<Event> loadAllEvents();
    @Query("SELECT * FROM events WHERE id=:id") public Event loadEventById(int id);
    @Query("SELECT * FROM events WHERE creator_id=:userId") public List<Event> loadEventsByCreator(int userId);

    @Insert public void insertChats(Chat... chats);
    @Update public void updateChats(Chat... chats);
    @Delete public void deleteChats(Chat... chats);
    @Query("SELECT * FROM chats") public List<Chat> loadAllChats();
    @Query("SELECT * FROM chats WHERE id=:id") public Chat loadChatById(int id);
}
