# High level overview

### **1️⃣ Create an Artisan Command for Syncing**  
We'll create a custom Laravel **Artisan Command** that will:  
✅ Fetch user data from Splynx (via API or direct DB query).  
✅ Compare it with Laravel’s `users` table.  
✅ Update Laravel’s database accordingly.  
✅ Log and handle errors.  

**Scaffolded Implementation:**  
```
app/Console/Commands/SyncSplynxUsers.php
```
```php
class SyncSplynxUsers extends Command
{
    protected $signature = 'sync:splynx-users';  // Command name
    protected $description = 'Sync user data from Splynx to Laravel';

    public function handle()
    {
        // 1️⃣ Fetch latest user data from Splynx (API or DB query)
        // 2️⃣ Loop through each user & update Laravel's users table
        // 3️⃣ Log results & handle any sync failures
    }
}
```

---

### **2️⃣ Schedule the Command to Run Automatically**  
Laravel’s `schedule` method ensures this sync runs at regular intervals.

**Scaffolded Implementation:**  
```
app/Console/Kernel.php
```
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('sync:splynx-users')->hourly(); // Runs every hour
}
```
✅ Runs the `sync:splynx-users` command **every hour**.  
✅ Can be adjusted (`daily()`, `everyTenMinutes()`, `everyFiveMinutes()`, etc.).  

---

### **3️⃣ Register the Cron Job on the Server**  
Laravel **doesn’t directly use `cron`** but relies on **one central cron job** that runs every minute.

✅ SSH into your server and edit the crontab:  
```sh
crontab -e
```
✅ Add this line to **execute Laravel’s scheduler every minute**:  
```sh
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```
🚀 Laravel will now **automatically run scheduled tasks**!

---

### **4️⃣ Handle Logging & Notifications (Optional but Recommended)**  
We should log success/failure & notify admins if sync fails.

**Scaffolded Implementation:**  
```php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

try {
    // Sync logic here
    Log::info('Splynx sync completed successfully');
} catch (\Exception $e) {
    Log::error('Splynx sync failed: ' . $e->getMessage());
    Notification::route('mail', 'admin@example.com')->notify(new SyncFailedNotification($e));
}
```
✅ Stores logs in `storage/logs/laravel.log`.  
✅ Sends an **email notification** if sync fails.

---

### **5️⃣ Run & Test the Command Manually**  
Before relying on cron jobs, test manually:  
```sh
php artisan sync:splynx-users
```
🔹 Check if users are syncing correctly.  
🔹 Review logs for errors or improvements.  

# Implementation
