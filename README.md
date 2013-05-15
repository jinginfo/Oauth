Allow anonymous user upload all file types into Dropbox

Use Oauth to give permission to put files directly to Dropbox sand box

Notice:

1. Since you are using Dropbox app, you need to make sure you are putting files    to sandbox not dropbox

2. oauth_token and oauth_access_token_secret are the final auth you need

3. Dropbox doesn't provide oauth_token_secret, oauth_token directly, you need to use call back and session to be autorize one time to get them
