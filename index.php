<?php
// Initialize session
session_start();

// Authentication credentials
$valid_username = 'tony';
$valid_password = 'ABcd@123456';

// Check if user is already logged in
$is_authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['authenticated'] = true;
        $is_authenticated = true;
        // Redirect to avoid form resubmission
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = 'Invalid username or password. Please try again.';
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// If not authenticated, show login page
if (!$is_authenticated) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Things To Do</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #e8f4f8 0%, #d4eaf5 100%);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .login-container {
                max-width: 420px;
                width: 100%;
            }

            .login-card {
                background: white;
                border-radius: 32px;
                padding: 40px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                border: 1px solid rgba(44, 155, 197, 0.2);
            }

            .login-header {
                text-align: center;
                margin-bottom: 32px;
            }

            .login-header h1 {
                font-size: 1.8rem;
                font-weight: 700;
                background: linear-gradient(135deg, #1a6d8f, #2c9bc5);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 8px;
            }

            .login-header p {
                color: #5a7c8c;
                font-size: 0.9rem;
            }

            .login-icon {
                font-size: 3rem;
                color: #2c9bc5;
                margin-bottom: 16px;
            }

            .form-group {
                margin-bottom: 24px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: #2c5a6e;
                font-size: 0.9rem;
            }

            .form-group label i {
                margin-right: 8px;
                color: #2c9bc5;
            }

            .form-group input {
                width: 100%;
                padding: 14px 16px;
                border: 2px solid #e0ecf2;
                border-radius: 16px;
                font-size: 0.95rem;
                font-family: 'Inter', sans-serif;
                transition: all 0.3s ease;
                background: #fafdff;
            }

            .form-group input:focus {
                outline: none;
                border-color: #2c9bc5;
                box-shadow: 0 0 0 4px rgba(44, 155, 197, 0.1);
            }

            .btn-login {
                width: 100%;
                background: linear-gradient(135deg, #2c9bc5, #1a6d8f);
                color: white;
                border: none;
                padding: 14px;
                border-radius: 40px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .btn-login:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(44, 155, 197, 0.3);
            }

            .error-message {
                background: #fee2e2;
                color: #e74c3c;
                padding: 12px 16px;
                border-radius: 16px;
                font-size: 0.85rem;
                margin-bottom: 24px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .error-message i {
                font-size: 1rem;
            }

            .demo-info {
                margin-top: 24px;
                padding-top: 24px;
                border-top: 1px solid #e0ecf2;
                text-align: center;
            }

            .demo-info p {
                color: #8aaec0;
                font-size: 0.8rem;
                margin-bottom: 8px;
            }

            .demo-credentials {
                background: #f0f7fa;
                padding: 10px;
                border-radius: 12px;
                font-size: 0.8rem;
                color: #2c5a6e;
            }

            .demo-credentials span {
                font-weight: 600;
                color: #1a6d8f;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h1>Things To Do</h1>
                    <p>Please login to continue</p>
                </div>

                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Username</label>
                        <input type="text" name="username" required autofocus>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// If authenticated, show the main application
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $messages = file_exists('message.txt') ? file('message.txt') : [];
        
        // Add new message
        if ($_POST['action'] === 'add' && !empty($_POST['deadline']) && !empty($_POST['title']) && !empty($_POST['message'])) {
            $newMessage = [
                'deadline' => htmlspecialchars($_POST['deadline']),
                'title' => htmlspecialchars($_POST['title']),
                'message' => htmlspecialchars($_POST['message']),
                'time' => time(),
                'id' => uniqid()
            ];
            file_put_contents('message.txt', json_encode($newMessage) . PHP_EOL, FILE_APPEND);
        }
        // Delete message
        elseif ($_POST['action'] === 'delete' && !empty($_POST['id'])) {
            $newMessages = [];
            foreach ($messages as $message) {
                $msg = json_decode(trim($message), true);
                if ($msg['id'] !== $_POST['id']) {
                    $newMessages[] = $message;
                }
            }
            file_put_contents('message.txt', implode('', $newMessages));
        }
        // Edit message
        elseif ($_POST['action'] === 'edit' && !empty($_POST['id']) && !empty($_POST['message'])) {
            $newMessages = [];
            foreach ($messages as $message) {
                $msg = json_decode(trim($message), true);
                if ($msg['id'] === $_POST['id']) {
                    $msg['message'] = htmlspecialchars($_POST['message']);
                    if (!empty($_POST['title'])) {
                        $msg['title'] = htmlspecialchars($_POST['title']);
                    }
                    if (!empty($_POST['deadline'])) {
                        $msg['deadline'] = htmlspecialchars($_POST['deadline']);
                    }
                    $msg['time'] = time();
                    $message = json_encode($msg) . PHP_EOL;
                }
                $newMessages[] = $message;
            }
            file_put_contents('message.txt', implode('', $newMessages));
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Read existing messages
$messages = [];
if (file_exists('message.txt')) {
    $fileMessages = file('message.txt');
    foreach ($fileMessages as $message) {
        $msg = json_decode(trim($message), true);
        if ($msg) {
            $messages[] = $msg;
        }
    }
    // Sort by deadline date in ASCENDING order (earliest deadline first)
    usort($messages, function($a, $b) {
        return strtotime($a['deadline']) <=> strtotime($b['deadline']);
    });
}

$today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Things To Do | Task Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e8f4f8 0%, #d4eaf5 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1a6d8f, #2c9bc5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .header p {
            color: #5a7c8c;
            font-size: 1rem;
            font-weight: 400;
        }

        .logout-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: rgba(44, 155, 197, 0.1);
            color: #1a6d8f;
            border: 1px solid rgba(44, 155, 197, 0.3);
            padding: 8px 16px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: rgba(44, 155, 197, 0.2);
            transform: translateY(-2px);
        }

        /* Form Section */
        .form-card {
            background: white;
            border-radius: 32px;
            padding: 32px;
            margin-bottom: 40px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(44, 155, 197, 0.2);
        }

        .form-card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a6d8f;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-card h2 i {
            color: #2c9bc5;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c5a6e;
            font-size: 0.9rem;
        }

        .form-group label i {
            margin-right: 8px;
            color: #2c9bc5;
        }

        input, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0ecf2;
            border-radius: 16px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: #fafdff;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #2c9bc5;
            box-shadow: 0 0 0 4px rgba(44, 155, 197, 0.1);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2c9bc5, #1a6d8f);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 40px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 155, 197, 0.3);
        }

        /* Messages Header */
        .messages-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .messages-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a6d8f;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sort-badge {
            background: rgba(44, 155, 197, 0.15);
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.8rem;
            color: #2c9bc5;
            font-weight: 500;
        }

        /* Messages List - ONE IN A ROW */
        .messages-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .message-card {
            background: white;
            border-radius: 24px;
            padding: 20px 24px;
            transition: all 0.3s ease;
            border: 1px solid rgba(44, 155, 197, 0.15);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            width: 100%;
        }

        .message-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(44, 155, 197, 0.12);
            border-color: rgba(44, 155, 197, 0.3);
        }

        /* Row layout for actions + deadline + created date */
        .card-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 16px;
        }

        .actions-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions-group button {
            background: none;
            border: none;
            cursor: pointer;
            color: #8aaec0;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 30px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .actions-group button:hover {
            background: #f0f7fa;
            color: #2c9bc5;
        }

        .actions-group form {
            display: inline;
        }

        .deadline-group {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .deadline-badge {
            background: linear-gradient(135deg, #2c9bc5, #1a6d8f);
            color: white;
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .deadline-badge.overdue {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .deadline-badge.soon {
            background: linear-gradient(135deg, #f39c12, #e67e22);
        }

        .created-date {
            font-size: 0.7rem;
            color: #8aaec0;
            background: #f0f7fa;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .task-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a6d8f;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .task-title i {
            color: #2c9bc5;
            font-size: 0.9rem;
        }

        .message-text {
            color: #3a6b80;
            line-height: 1.6;
            margin-top: 8px;
            font-size: 0.95rem;
            background: #fafdff;
            padding: 14px;
            border-radius: 14px;
            border-left: 3px solid #2c9bc5;
        }

        .edit-form {
            display: none;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #eef4f8;
        }

        .edit-form textarea,
        .edit-form input {
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .btn-update {
            background: linear-gradient(135deg, #27ae60, #229954);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            margin-right: 8px;
        }

        .btn-cancel {
            background: #e0ecef;
            color: #5a7c8c;
            border: none;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 32px;
            color: #8aaec0;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 16px;
            color: #cde5ef;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }
            .card-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .actions-group {
                order: 1;
            }
            .deadline-group {
                order: 2;
            }
            .logout-btn {
                position: static;
                display: inline-block;
                margin-top: 15px;
            }
            .header {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header with Logout -->
    <div class="header">
        <h1><i class="fas fa-check-circle"></i> Things To Do</h1>
        <p>Stay organized, never miss a deadline</p>
        <a href="?logout=1" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Add Form -->
    <div class="form-card">
        <h2><i class="fas fa-plus-circle"></i> Add New Task</h2>
        <form method="post">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label><i class="far fa-calendar-alt"></i> Deadline Date</label>
                <input type="date" name="deadline" required min="<?= $today ?>">
            </div>
            <div class="form-group">
                <label><i class="fas fa-heading"></i> Title</label>
                <input type="text" name="title" required placeholder="Enter task title...">
            </div>
            <div class="form-group">
                <label><i class="fas fa-edit"></i> Description</label>
                <textarea name="message" required placeholder="Enter task details..."></textarea>
            </div>
            <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Save Task</button>
        </form>
    </div>

    <!-- Messages List -->
    <div class="messages-header">
        <h2><i class="fas fa-list-ul"></i> My Tasks</h2>
        <div class="sort-badge"><i class="fas fa-sort-amount-up-alt"></i> Sorted by deadline (earliest first)</div>
    </div>

    <?php if (empty($messages)): ?>
        <div class="empty-state">
            <i class="fas fa-clipboard-list"></i>
            <p>No tasks yet. Create your first task above!</p>
        </div>
    <?php else: ?>
        <div class="messages-list">
            <?php
            $todayTimestamp = strtotime($today);
            $weekLater = strtotime('+7 days', $todayTimestamp);
            foreach ($messages as $message):
                $deadlineTimestamp = strtotime($message['deadline']);
                $isPastDue = $deadlineTimestamp < $todayTimestamp;
                $isSoon = !$isPastDue && $deadlineTimestamp <= $weekLater;
                $badgeClass = $isPastDue ? 'overdue' : ($isSoon ? 'soon' : '');
                $badgeIcon = $isPastDue ? '<i class="fas fa-times-circle"></i>' : ($isSoon ? '<i class="fas fa-clock"></i>' : '<i class="fas fa-calendar-day"></i>');
                $badgeText = $isPastDue ? 'Overdue' : ($isSoon ? 'Due Soon' : date('M j, Y', $deadlineTimestamp));
                ?>
                <div class="message-card" id="message-<?= $message['id'] ?>">
                    <!-- Row with actions on left, deadline and date on right -->
                    <div class="card-row">
                        <div class="actions-group">
                            <button onclick="showEditForm('<?= $message['id'] ?>')"><i class="fas fa-pen"></i> Edit</button>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $message['id'] ?>">
                                <button type="submit" onclick="return confirm('Delete this task?')"><i class="fas fa-trash-alt"></i> Delete</button>
                            </form>
                        </div>
                        <div class="deadline-group">
                            <span class="deadline-badge <?= $badgeClass ?>">
                                <?= $badgeIcon ?> <?= $badgeText ?>
                            </span>
                            <span class="created-date"><i class="far fa-clock"></i> <?= date('M j, g:i A', $message['time']) ?></span>
                        </div>
                    </div>
                    <!-- Task Title -->
                    <div class="task-title">
                        <i class="fas fa-tag"></i> <?= htmlspecialchars($message['title']) ?>
                    </div>
                    <!-- Task Description -->
                    <div class="message-text">
                        <?= nl2br(htmlspecialchars($message['message'])) ?>
                    </div>
                    <div class="edit-form" id="edit-form-<?= $message['id'] ?>">
                        <form method="post">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?= $message['id'] ?>">
                            <div class="form-group">
                                <label><i class="far fa-calendar-alt"></i> Update Deadline (optional)</label>
                                <input type="date" name="deadline" value="<?= $message['deadline'] ?>" min="<?= $today ?>">
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-heading"></i> Update Title</label>
                                <input type="text" name="title" value="<?= htmlspecialchars($message['title']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-edit"></i> Update Description</label>
                                <textarea name="message" required><?= htmlspecialchars($message['message']) ?></textarea>
                            </div>
                            <button type="submit" class="btn-update"><i class="fas fa-check"></i> Update</button>
                            <button type="button" class="btn-cancel" onclick="hideEditForm('<?= $message['id'] ?>')"><i class="fas fa-times"></i> Cancel</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    function showEditForm(id) {
        document.querySelectorAll('.edit-form').forEach(form => {
            form.style.display = 'none';
        });
        document.getElementById('edit-form-' + id).style.display = 'block';
    }
    function hideEditForm(id) {
        document.getElementById('edit-form-' + id).style.display = 'none';
    }
</script>
</body>
</html>