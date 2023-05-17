# Chat App
This is a Chat App that allows users to create groups and send messages within those groups.

## Getting Started
These instructions will guide you on how to set up and run the Chat App locally on your machine.

## Prerequisites
Before running the Chat App, make sure you have the following software installed:

##### PHP 7.4 or higher
##### Composer
##### MySQL
##### Installing
##### Clone the repository:

### bash
git clone https://github.com/your-username/chat-app.git or use zip file
Install the dependencies using Composer:

### bash
cd chat-app
composer install
Configure the database connection by editing the config.php file.

### bash
php -S localhost:8000 -t public
Open your browser and access the Chat App at http://localhost:8000.

## Usage
The Chat App provides the following API endpoints:

### Get all groups
Endpoint: /groups
Method: GET
Description: Retrieves a list of all groups.
Response: Returns a JSON array containing the group data.

### Create a group
Endpoint: /groups
Method: POST
Description: Creates a new group.
Request Body: Expects a JSON object with a name field (optional).
Response: Returns the ID and name of the created group as a JSON object.

### Get messages of a specific group
Endpoint: /groups/{id}
Method: GET
Description: Retrieves all messages of a specific group.
Response: Returns a JSON array containing the message data.

### Send a message to a group
Endpoint: /groups/{id}
Method: POST
Description: Sends a message to a specific group.
Request Body: Expects a JSON object with user_id and messages fields.
Response: Returns the ID, group ID, user ID, and message content as a JSON object.

##  Database Structure
The Chat App uses the following database tables:

### groups
Column	    Type
id	        int
name	    varchar

### messages
Column	    Type
id	        int
group_id	int
user_id	    int
messages	text

### Contributing
Contributions are welcome! If you find any issues or have suggestions for improvement, please contact with me.
