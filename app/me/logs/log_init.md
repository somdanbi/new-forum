#### commit 30.
    - now recording in the db favorites in activities, (however is you check this activity in user profile, it breaks).
    - last issue was fixed (it a view exists show it).
    - link/jump to specific reply from user profile.
#### commit 31.
    - A unauthorized user can not delete a reply.
    - Creating a Test for it.
    - Test for Authorized users (can delete a reply).
    - Create a Reply policy
    - Finally. Delete a reply.
    - Full Test ok.

#### commit 32.
    - Vue: Editing a textarea
    - Vue: Error: 405 Method Not Allowed
    - setting an endpoint
    - Test: update a reply.
    - Test: unauthorized users cannot update replies
    - now you can update a reply, but it needs to refresh the page to see it. (fixed).
    - now you can delete a reply

#### commit 34... now you can:
    - CREATING VUE FAVORITES FORM.
    * creating static favoritecounter number 10. 
    * creating dynamic favoritecounter.
    * using fontAwesome
#### commit 35
    - page.test/manu
    - fixing (after you unfavorited a reply it blows up.)
    - fixing (after favorited then unfavorited a reply then delete a reply it blows up.)
    - fixing (favorited icon only visible if you are log in)

#### commit 36
    - CREATING REPLIES COMPONENT (for listing)

#### commit 37
    - 

#### commit 39
    - Fixing Scroll page, (threads/show) go to the top after refresh the page.
    - Working on unanswered threads.
    - issue: the tutor create refresh the migrations, then create 100 threads, finally create 30 replies for a latest thread, it works for him but not for me. the counter column is not been updated after I run the query in tinker. 
