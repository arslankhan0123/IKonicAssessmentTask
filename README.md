
1. Begin by cloning the project from this GitHub repository: GitHub Repository Link.
        -- https://github.com/arslankhan0123/IKonicTask.git

2. Next, execute the following commands:

        -- Run composer install.
        -- Use the command php artisan migrate to create the database and tables.
        -- Update .env file and put smtp credentials for Email notification when user comments on Feedback.
        -- Create an Admin User with the command php artisan db:seed (by setting up a seeder for the admin user).
        -- Finally, launch the application with php artisan serve.

3. Users can log in, register, or log out.

4. Admin users have the ability to create users with different roles. Simple users can register themselves by clicking on the "Register a new account" button.

5. Both admin and simple users can create feedback entries. These feedback entries are displayed in a table, along with buttons for commenting and voting. Clicking the vote button assigns a vote to the feedback, while clicking the comment icon opens a comments section associated with the feedback, displaying all comments related to that feedback.

6. Only Admins can create, update, or delete users with various roles. Simple users cannot access the user pages, and any attempt to access them results in a redirection. Middleware is used to enforce this restriction.

7. Admin users have the exclusive ability to create, update, or delete users. They can also update or delete feedback entries and update or delete user comments.

8. Admin users can enable or disable comments for specific users. By clicking on the comments enable tab, Admins can select a user to block comments for, choose whether to enable or disable comments, and save their settings.

9. Only Admin users can access the user comments enables pages because only Admin users can block the users comments.

10. User can comment on feedbacks using Text Editor.

11. A Rich Text Editor is also implemented in a separate tab. Users can click on the "Rich text editor" tab, as it may take some time to load due to network issues because I'm using online scripts from Summernote and because I'm in a village and i have a bad network here So that's why it takes time to load the Rich Text Editor. This tab displays a textarea where the Rich Text Editor can be utilized.

12. When an admin selects a user and marks them as "disabled" and saves the changes, the selected user will be unable to comment on feedbacks.

13. For showing Feedback in a table I use Datatables for Searching and Pagination and For showing comments I use Laravel Pagination.

14. User have profile option there he can see just all his feedbacks and use Laravel Paginations. The LogedIn user cannot see other feedbacks in his profile.

15. When user comment on my feedback i got notification in the web(in header i have notification icon there i get all notifications) and also i get an email of when user comment on my email.
