<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-mono text-[11px] tracking-wider uppercase text-ink-soft mb-1.5 font-bold">Email Panitia</label>
            <input id="email" class="block w-full border border-line rounded-xl px-3.5 py-2.5 text-sm bg-paper-warm/30 focus:outline-none focus:border-ember focus:ring-1 focus:ring-ember transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-mono text-[11px] tracking-wider uppercase text-ink-soft mb-1.5 font-bold">Kata Sandi</label>
            <input id="password" class="block w-full border border-line rounded-xl px-3.5 py-2.5 text-sm bg-paper-warm/30 focus:outline-none focus:border-ember focus:ring-1 focus:ring-ember transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-600 text-xs" />
        </div>

        <!-- Remember Me & Custom Action -->
        <div class="flex items-center justify-between text-xs">
            <label for="remember_me" class="inline-flex items-center text-ink-soft cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-line text-ember focus:ring-ember" name="remember">
                <span class="ms-2 font-medium">Ingat Saya</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full text-center bg-gradient-to-r from-ember to-ember-dark text-white font-semibold text-sm px-6 py-3 rounded-full transition-premium hover:shadow-[0_10px_20px_-5px_rgba(226,101,11,0.4)] hover:-translate-y-0.5 active:translate-y-0 shadow-sm">
                Masuk ke Panel Admin →
            </button>
        </div>
    </form>
</x-guest-layout>

