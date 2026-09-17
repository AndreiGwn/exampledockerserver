<div x-data="gshotelReserveModal()" 
     @open-reserve-modal.window="openModal($event.detail)"
     @keydown.escape.window="closeModal()"
     x-show="isOpen" 
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;"
     x-cloak>
    
    <!-- Serene Backdrop -->
    <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity duration-300" 
         @click="closeModal()"
         x-show="isOpen"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-slate-900 text-left shadow-2xl border border-amber-500/20 transition-all sm:my-8 sm:w-full sm:max-w-xl p-6 sm:p-8"
             x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95">

            <!-- Close Button -->
            <button type="button" @click="closeModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- State 1: Thank you message & Reservation Form -->
            <div x-show="!isSuccess">
                <!-- Warm Hospitality Header -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 mb-3 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">
                        Thank you for reserving
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-md mx-auto">
                        Please provide your contact details below so our concierge can arrange your serene luxury experience at GSHotel.
                    </p>
                </div>

                <!-- Selected Hotel Preview Banner -->
                <div class="flex items-center gap-4 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 mb-6">
                    <img :src="hotelData.image_url" :alt="hotelData.name" class="w-16 h-16 rounded-xl object-cover shadow-sm">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-md bg-amber-500/10 text-amber-700 dark:text-amber-300" x-text="(hotelData.star_rating || 5) + ' ★ Luxury'"></span>
                            <span class="text-xs text-slate-400" x-text="hotelData.city"></span>
                        </div>
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white truncate" x-text="hotelData.name"></h4>
                        <div class="text-xs font-bold text-amber-600 dark:text-amber-400 mt-0.5">
                            €<span x-text="hotelData.price_per_night"></span> <span class="text-[10px] text-slate-400 font-normal">/ night</span>
                        </div>
                    </div>
                </div>

                <!-- Error Alert if Any -->
                <div x-show="errorMessage" class="mb-4 p-3 rounded-xl bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 text-xs font-semibold" x-text="errorMessage"></div>

                <!-- Form -->
                <form @submit.prevent="submitReservation()" class="space-y-4">
                    <input type="hidden" name="hotel_id" :value="hotelData.id">
                    <input type="hidden" name="room_id" :value="hotelData.room_id || ''">

                    <!-- Guest Name -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                            Your Full Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" x-model="form.guest_name" required placeholder="e.g. Eleanor Vance" class="w-full px-4 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition">
                    </div>

                    <!-- Email & Phone Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                                Mail Address <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" x-model="form.guest_email" required placeholder="eleanor@example.com" class="w-full px-4 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                                Phone Number <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel" x-model="form.guest_phone" required placeholder="+31 6 1234 5678" class="w-full px-4 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition">
                        </div>
                    </div>

                    <!-- Home Address (Optional) -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                            Home Address <span class="text-slate-400 font-normal lowercase">(optional)</span>
                        </label>
                        <input type="text" x-model="form.guest_address" placeholder="e.g. Keizersgracht 100, 1015 AA Amsterdam" class="w-full px-4 py-2.5 rounded-xl text-sm bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition">
                    </div>

                    <!-- Dates & Guests -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Check-in Date</label>
                            <input type="date" x-model="form.check_in" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Check-out Date</label>
                            <input type="date" x-model="form.check_out" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 dark:text-slate-400 mb-1">Guests</label>
                            <select x-model="form.guests_count" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 outline-none">
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4+ Guests</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit / Send Button -->
                    <div class="pt-3">
                        <button type="submit" :disabled="isSubmitting" class="w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-amber-600 via-amber-500 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-black text-sm tracking-wider uppercase shadow-xl shadow-amber-500/25 transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2">
                            <span x-show="!isSubmitting">Send Reservation</span>
                            <span x-show="isSubmitting" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                                <span>Securing Reservation...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- State 2: Success Confirmation UI -->
            <div x-show="isSuccess" class="text-center py-4 space-y-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 mx-auto animate-bounce">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400">Reservation Confirmed</span>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">Thank you for reserving!</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 max-w-md mx-auto">
                        Your reservation for <strong class="text-slate-800 dark:text-slate-200" x-text="hotelData.name"></strong> has been secured with reference code:
                    </p>
                    <div class="inline-block mt-3 px-5 py-2.5 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-700 dark:text-amber-300 font-mono font-black text-lg tracking-widest shadow-inner" x-text="confirmedCode"></div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 text-left text-xs space-y-1.5 text-slate-600 dark:text-slate-300">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Guest Name:</span>
                        <strong class="text-slate-800 dark:text-white" x-text="form.guest_name"></strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Mail Address:</span>
                        <span x-text="form.guest_email"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Phone:</span>
                        <span x-text="form.guest_phone"></span>
                    </div>
                </div>

                <!-- Navigation Actions (SPA Tab Switch to preserve continuous audio) -->
                <div class="space-y-3 pt-2">
                    <button type="button" @click="goToReserved()" class="w-full py-3.5 px-6 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white dark:bg-amber-600 dark:hover:bg-amber-700 font-black text-xs uppercase tracking-wider shadow-lg transition text-center flex items-center justify-center gap-2">
                        <span>Go to "Reserved" Tab to View Your Stay</span>
                        <span>→</span>
                    </button>
                    <button type="button" @click="closeModal()" class="block w-full text-xs text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 py-2">
                        Close & Continue Exploring
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function gshotelReserveModal() {
    return {
        isOpen: false,
        isSubmitting: false,
        isSuccess: false,
        errorMessage: '',
        confirmedCode: '',
        hotelData: {
            id: null,
            room_id: null,
            name: '',
            city: '',
            star_rating: 5,
            price_per_night: '0.00',
            image_url: '',
        },
        form: {
            guest_name: '',
            guest_email: '',
            guest_phone: '',
            guest_address: '',
            check_in: '',
            check_out: '',
            guests_count: 2,
            special_requests: '',
        },

        init() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const checkOut = new Date(today);
            checkOut.setDate(checkOut.getDate() + 4);

            this.form.check_in = tomorrow.toISOString().split('T')[0];
            this.form.check_out = checkOut.toISOString().split('T')[0];
        },

        openModal(data) {
            this.hotelData = Object.assign({}, this.hotelData, data);
            this.isSuccess = false;
            this.errorMessage = '';
            this.isOpen = true;
        },

        closeModal() {
            this.isOpen = false;
        },

        goToReserved() {
            this.isOpen = false;
            // Access root Alpine app instance to switch tab seamlessly without page reload
            const root = document.querySelector('[x-data*="gshotelApp"]');
            if (root && root._x_dataStack) {
                const app = root._x_dataStack[0];
                if (app && app.switchTab) {
                    app.switchTab('reserved');
                }
            }
        },

        submitReservation() {
            this.isSubmitting = true;
            this.errorMessage = '';

            fetch('{{ route("reservations.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    hotel_id: this.hotelData.id,
                    room_id: this.hotelData.room_id || null,
                    guest_name: this.form.guest_name,
                    guest_email: this.form.guest_email,
                    guest_phone: this.form.guest_phone,
                    guest_address: this.form.guest_address,
                    check_in: this.form.check_in,
                    check_out: this.form.check_out,
                    guests_count: this.form.guests_count,
                    special_requests: this.form.special_requests,
                })
            })
            .then(res => res.json())
            .then(data => {
                this.isSubmitting = false;
                if (data.success) {
                    this.isSuccess = true;
                    this.confirmedCode = data.reservation_code;
                    // Dispatch event with created reservation for instant Alpine sync
                    window.dispatchEvent(new CustomEvent('reservation-created', { detail: data.reservation }));
                } else {
                    this.errorMessage = data.message || 'Error securing your reservation. Please check all fields.';
                }
            })
            .catch(err => {
                this.isSubmitting = false;
                this.errorMessage = 'Network error. Please try again.';
            });
        }
    };
}
</script>
