 role="staff" :user="auth()->user()">
    <h1 class="text-3xl font-bold mb-4">Welcome, {{ auth()->user()->name }}</h1>
    <p>This is your staff dashboard. You can manage trips and passenger information here.</p>

