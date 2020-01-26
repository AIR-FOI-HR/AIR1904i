package com.example.model;

/**
 * The type Sport.
 */
public class Sport {

    private int id;
    private String name;
    private String description;
    private int minPlayers;
    private int maxPlayers;

    /**
     * Gets id.
     *
     * @return the id
     */
    public int getId() {
        return id;
    }

    /**
     * Sets id.
     *
     * @param id the id
     */
    public void setId(int id) {
        this.id = id;
    }

    /**
     * Gets name.
     *
     * @return the name
     */
    public String getName() {
        return name;
    }

    /**
     * Sets name.
     *
     * @param name the name
     */
    public void setName(String name) {
        this.name = name;
    }

    /**
     * Gets description.
     *
     * @return the description
     */
    public String getDescription() {
        return description;
    }

    /**
     * Sets description.
     *
     * @param description the description
     */
    public void setDescription(String description) {
        this.description = description;
    }

    /**
     * Gets min players.
     *
     * @return the min players
     */
    public int getMinPlayers() {
        return minPlayers;
    }

    /**
     * Sets min players.
     *
     * @param minPlayers the min players
     */
    public void setMinPlayers(int minPlayers) {
        this.minPlayers = minPlayers;
    }

    /**
     * Gets max players.
     *
     * @return the max players
     */
    public int getMaxPlayers() {
        return maxPlayers;
    }

    /**
     * Sets max players.
     *
     * @param maxPlayers the max players
     */
    public void setMaxPlayers(int maxPlayers) {
        this.maxPlayers = maxPlayers;
    }
}
