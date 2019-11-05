package hr.foi.air.database;

import androidx.room.Database;
import androidx.room.RoomDatabase;

import hr.foi.air.database.entities.*;

@Database(version=1,
        entities = {User.class, Sport.class},
        views = {},
        exportSchema = false)
public abstract class SportDatabase extends RoomDatabase {
}
