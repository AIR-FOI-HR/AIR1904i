package hr.foi.air.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.ForeignKey;
import androidx.room.PrimaryKey;
import androidx.room.TypeConverters;

import java.util.Date;

import hr.foi.air.database.converters.DateConverter;

@Entity(tableName = "events")
@TypeConverters(DateConverter.class)
public class Event {
    @PrimaryKey(autoGenerate = true)
    int id;

    String title;
    String description;

    @ColumnInfo(name = "creation_date")
    Date creationDate;
    @ColumnInfo(name = "start_time")
    Date startTime;
    @ColumnInfo(name = "location_addr")
    String address;
    @ColumnInfo(name = "location_lon")
    Double longitude;
    @ColumnInfo(name = "location_lat")
    Double latitude;
    @ForeignKey(entity = User.class, parentColumns = "id", childColumns = "creator_id")
    @ColumnInfo(index = true, name = "creator_id")
    int creatorId;
    @ForeignKey(entity = Sport.class, parentColumns = "id", childColumns = "sport_id")
    @ColumnInfo(index = true, name = "sport_id")
    int sportId;

    public int getSportId() {
        return sportId;
    }

    public void setSportId(int sportId) {
        this.sportId = sportId;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public Date getCreationDate() {
        return creationDate;
    }

    public void setCreationDate(Date creationDate) {
        this.creationDate = creationDate;
    }

    public Date getStartTime() {
        return startTime;
    }

    public void setStartTime(Date startTime) {
        this.startTime = startTime;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public Double getLongitude() {
        return longitude;
    }

    public void setLongitude(Double longitude) {
        this.longitude = longitude;
    }

    public Double getLatitude() {
        return latitude;
    }

    public void setLatitude(Double latitude) {
        this.latitude = latitude;
    }

    public int getCreatorId() {
        return creatorId;
    }

    public void setCreatorId(int creatorId) {
        this.creatorId = creatorId;
    }
}
