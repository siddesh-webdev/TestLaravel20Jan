<form id="addform">
    @csrf
    <input type="hidden" name="user_id" value="{{ !empty($userData)?$userData[0]['id']:'' }}">
    <label for="fname">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ !empty($userData)?$userData[0]['name']:'' }}" required><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="{{ !empty($userData)?$userData[0]['email']:'' }}" required><br>
    <label for="role">Role:</label><br>
    <input type="text" id="role" name="role" value="{{ !empty($userData)?$userData[0]['role']:'' }}" required><br><br>
    <button id ="submitUser" type="submit">Submit</button>
</form>