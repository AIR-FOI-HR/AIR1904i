package hr.foi.air.database;

import android.content.Context;

import androidx.room.Database;
import androidx.room.Room;
import androidx.room.RoomDatabase;

import hr.foi.air.database.entities.*;

@Database(version=1,
        entities = {User.class, Sport.class, Event.class, Setting.class, Chat.class, Message.class, Participation.class, EventApplication.class},
        views = {},
        exportSchema = false)
public abstract class SportDatabase extends RoomDatabase {

    public static final String NAME = "main";
    public static final int VERSION = 1;

    private static SportDatabase INSTANCE = null;

    public synchronized static SportDatabase getInstance(final Context context) {
        if (INSTANCE == null) {
            INSTANCE = Room.databaseBuilder(
                    context.getApplicationContext(),
                    SportDatabase.class,
                    SportDatabase.NAME
            ).allowMainThreadQueries().build();
        }
        return INSTANCE;
    }

    public abstract DAO getDAO();
}
