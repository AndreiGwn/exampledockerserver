<div x-data="gshotelMusicPlayer()" x-init="initAudio()" class="fixed bottom-5 right-5 z-50">
    <!-- Compact Floating Sauna Ambience Controller -->
    <div class="relative flex items-center gap-2.5 bg-slate-950/90 text-white backdrop-blur-xl px-3.5 py-2 rounded-2xl shadow-2xl border border-amber-500/30 transition-all duration-300 hover:border-amber-500/60 hover:shadow-amber-500/10">
        
        <!-- Animated Mini Soundwave -->
        <div class="flex items-center gap-0.5 h-4 cursor-pointer px-0.5" @click="togglePlay()" title="Toggle Sauna Ambience">
            <span class="w-0.5 bg-amber-400 rounded-full transition-all duration-200" :class="isPlaying && !isMuted ? 'h-4 animate-pulse' : 'h-1.5 opacity-40'"></span>
            <span class="w-0.5 bg-amber-300 rounded-full transition-all duration-200" :class="isPlaying && !isMuted ? 'h-2.5 animate-bounce' : 'h-1.5 opacity-40'" style="animation-delay: 100ms"></span>
            <span class="w-0.5 bg-amber-500 rounded-full transition-all duration-200" :class="isPlaying && !isMuted ? 'h-3.5 animate-pulse' : 'h-1.5 opacity-40'" style="animation-delay: 200ms"></span>
        </div>

        <!-- Sauna Sound Title -->
        <div class="text-left pr-1.5 cursor-pointer select-none" @click="togglePlay()">
            <div class="flex items-center gap-1.5">
                <span class="inline-block w-1.5 h-1.5 rounded-full" :class="isPlaying && !isMuted ? 'bg-emerald-400 animate-ping' : 'bg-slate-500'"></span>
                <span class="text-[10px] font-bold tracking-wider uppercase text-amber-300">Sauna & Spa Ambience</span>
            </div>
            <span class="block text-[9px] text-slate-400" x-text="isPlaying ? (isMuted ? 'Muted' : 'Relaxing Thermal Sound') : 'Click to Play'"></span>
        </div>

        <!-- Play / Pause Button -->
        <button type="button" @click="togglePlay()" class="w-7 h-7 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white flex items-center justify-center shadow-md shadow-amber-600/30 transition hover:scale-105 active:scale-95" :title="isPlaying ? 'Pause Sauna Sound' : 'Play Sauna Sound'">
            <template x-if="!isPlaying">
                <svg class="w-3.5 h-3.5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </template>
            <template x-if="isPlaying">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </template>
        </button>

        <!-- Mute / Unmute Button -->
        <button type="button" @click="toggleMute()" class="w-7 h-7 rounded-xl bg-slate-800/90 hover:bg-slate-800 text-amber-300 flex items-center justify-center transition" :title="isMuted ? 'Unmute' : 'Mute'">
            <template x-if="!isMuted">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                </svg>
            </template>
            <template x-if="isMuted">
                <svg class="w-3.5 h-3.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                </svg>
            </template>
        </button>

    </div>
</div>

<script>
function gshotelMusicPlayer() {
    return {
        isPlaying: false,
        isMuted: false,
        volume: 0.35,
        audioElement: null,
        audioCtx: null,
        gainNode: null,
        synthInterval: null,

        // Single Dedicated Relaxing Sauna & Spa Soundscape
        saunaTrackUrl: 'https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3?filename=relaxing-mountains-nature-walk-112191.mp3',

        initAudio() {
            const savedMute = localStorage.getItem('gshotel_music_muted');
            if (savedMute !== null) {
                this.isMuted = savedMute === 'true';
            }

            this.audioElement = new Audio(this.saunaTrackUrl);
            this.audioElement.loop = true;
            this.audioElement.volume = this.isMuted ? 0 : this.volume;
            this.audioElement.muted = this.isMuted;

            this.audioElement.addEventListener('error', () => {
                this.setupSaunaSynthAmbience();
            });
        },

        togglePlay() {
            if (!this.audioElement) {
                this.initAudio();
            }

            if (this.isPlaying) {
                this.audioElement.pause();
                this.isPlaying = false;
                if (this.audioCtx) this.audioCtx.suspend();
            } else {
                this.audioElement.muted = this.isMuted;
                this.audioElement.volume = this.isMuted ? 0 : this.volume;
                this.audioElement.play().then(() => {
                    this.isPlaying = true;
                }).catch(() => {
                    this.setupSaunaSynthAmbience();
                    this.isPlaying = true;
                });
            }
        },

        toggleMute() {
            this.isMuted = !this.isMuted;
            localStorage.setItem('gshotel_music_muted', this.isMuted);

            if (this.audioElement) {
                this.audioElement.muted = this.isMuted;
                this.audioElement.volume = this.isMuted ? 0 : this.volume;
            }

            if (this.gainNode && this.audioCtx) {
                this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : 0.04, this.audioCtx.currentTime);
            }

            if (!this.isPlaying && !this.isMuted) {
                this.togglePlay();
            }
        },

        setupSaunaSynthAmbience() {
            try {
                if (!this.audioCtx) {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    this.audioCtx = new AudioContext();
                    this.gainNode = this.audioCtx.createGain();
                    this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : 0.03, this.audioCtx.currentTime);
                    this.gainNode.connect(this.audioCtx.destination);
                }

                if (this.audioCtx.state === 'suspended') {
                    this.audioCtx.resume();
                }

                // Generates deep, warm relaxing sauna & spa resonance drones
                const droneNotes = [130.81, 196.00, 261.63, 329.63]; // C3, G3, C4, E4
                const playSaunaTone = () => {
                    if (!this.isPlaying || this.isMuted) return;
                    const freq = droneNotes[Math.floor(Math.random() * droneNotes.length)];
                    const osc = this.audioCtx.createOscillator();
                    const noteGain = this.audioCtx.createGain();

                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, this.audioCtx.currentTime);

                    noteGain.gain.setValueAtTime(0, this.audioCtx.currentTime);
                    noteGain.gain.linearRampToValueAtTime(0.02, this.audioCtx.currentTime + 2.5);
                    noteGain.gain.exponentialRampToValueAtTime(0.0001, this.audioCtx.currentTime + 8.5);

                    osc.connect(noteGain);
                    noteGain.connect(this.gainNode);

                    osc.start();
                    osc.stop(this.audioCtx.currentTime + 9);
                };

                playSaunaTone();
                if (this.synthInterval) clearInterval(this.synthInterval);
                this.synthInterval = setInterval(playSaunaTone, 4500);
            } catch (e) {
                console.log('Sauna ambient generator active');
            }
        }
    };
}
</script>
