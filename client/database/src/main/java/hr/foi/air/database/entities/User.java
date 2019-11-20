package hr.foi.air.database.entities;

import android.graphics.Bitmap;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;
import androidx.room.TypeConverters;

import java.util.Date;

import hr.foi.air.database.converters.BitmapConverter;
import hr.foi.air.database.converters.DateConverter;

@Entity(tableName = "users")
@TypeConverters({DateConverter.class, BitmapConverter.class})
public class User {
    @PrimaryKey(autoGenerate = true)
    int id;

    String email;
    String username;
    String password;

    @ColumnInfo(name="phone_number")
    String phoneNumber;
    @ColumnInfo(name="first_name")
    String firstName;
    @ColumnInfo(name="last_name")
    String lastName;
    @ColumnInfo(name="birth_date")
    Date birthDate;
    @ColumnInfo(name="register_date")
    Date registerDate;
    @ColumnInfo(name="activation_code")
    String activationCode;
    @ColumnInfo(name="profile_img")
    Bitmap profileImg;
    @ColumnInfo(name="address")
    String address;
    @ColumnInfo(name="longitude")
    Double longitude;
    @ColumnInfo(name="latitude")
    Double latitude;

    public Bitmap getProfileImg() {
        return profileImg;
    }

    public void setProfileImg(Bitmap profileImg) {
        this.profileImg = profileImg;
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

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) { this.email = email; }

    public String getPhoneNumber() {
        return phoneNumber;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.phoneNumber = phoneNumber;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getFirstName() {
        return firstName;
    }

    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public Date getBirthDate() {
        return birthDate;
    }

    public void setBirthDate(Date birthDate) {
        this.birthDate = birthDate;
    }

    public Date getRegisterDate() {
        return registerDate;
    }

    public void setRegisterDate(Date registerDate) {
        this.registerDate = registerDate;
    }

    public String getActivationCode() {
        return activationCode;
    }

    public void setActivationCode(String activationCode) {
        this.activationCode = activationCode;
    }
}
