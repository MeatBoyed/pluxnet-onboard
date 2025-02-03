# pluxnet-onboard

# Syncronization
- Create a Command (Cronjob) to Query & Sync data from Splynx
- Register Cron Job to Laravel
- Test Cronject 
- error handling


## Checklist
✅ Application is running in APP_ENV=production mode
✅ All debug and error reporting is disabled
✅ Database credentials & secret keys are securely stored
✅ Assets are compiled & optimized
✅ Web server points to public/ directory
✅ Proper permissions are set for storage & cache
✅ Background workers (queues) are managed via Supervisor
✅ Scheduled tasks are set up via Cron
✅ SSL and security headers are configured



# Deployment

### Query

Deploying Laravel - https://stackoverflow.com/questions/59663762/laravel-what-steps-should-one-take-to-make-a-laravel-app-ready-for-production

- Connect to Splynx in Localhost dev
- Port configurations/networking for Docker

- Create first production build
- Optomise and save scripts

- Create Docker Container configuring image to spec
- Provide Repo & Build files necessary


## Finished Tasks

**Implement PluxNet branding - Dashboard & Register**
- DONE - Use new PluxNet logo
- DONE - Change background to PN theme
- DONE - Add Welcoming Card to Dashboard (Only Dash)
- DONE - Create Welcoming page (Force to register)
- DONE - Make Pages Responsive

**Functional**
- DONE - Add JS to Copy EasyPay Number
- Add Select dropdown to Tarrifs
- Add Error Handling!

**EasyPay Number**
- DONE - Create EasyPay Service to generate EasyPay numbers 
- DONE - Save EasyPay number after Customer Registeration (in form)

