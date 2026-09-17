<div x-data="gshotelMusicPlayer()" x-init="initAudio()" class="fixed bottom-6 right-6 z-50">
    <!-- Floating Luxury Audio Player Widget -->
    <div class="relative flex items-center gap-3 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl px-4 py-3 rounded-2xl shadow-2xl border border-slate-200/80 dark:border-slate-800 transition-all duration-300 hover:shadow-indigo-500/10">
        
        <!-- Audio Waves Animation -->
        <div class="flex items-center gap-1 h-5 cursor-pointer" @click="togglePlay()" title="Toggle Ambient Audio">
            <span class="w-1 bg-amber-500 rounded-full transition-all duration-300" :class="isPlaying && !isMuted ? 'h-5 animate-pulse' : 'h-1.5 opacity-40'"></span>
            <span class="w-1 bg-amber-600 rounded-full transition-all duration-300" :class="isPlaying && !isMuted ? 'h-3 animate-bounce' : 'h-1.5 opacity-40'" style="animation-delay: 150ms"></span>
            <span class="w-1 bg-amber-400 rounded-full transition-all duration-300" :class="isPlaying && !isMuted ? 'h-6 animate-pulse' : 'h-1.5 opacity-40'" style="animation-delay: 300ms"></span>
            <span class="w-1 bg-amber-500 rounded-full transition-all duration-300" :class="isPlaying && !isMuted ? 'h-4 animate-bounce' : 'h-1.5 opacity-40'" style="animation-delay: 75ms"></span>
        </div>

        <!-- Track & Status Info -->
        <div class="hidden sm:block text-left pr-2 cursor-pointer" @click="togglePlay()">
            <div class="flex items-center gap-1.5">
                <span class="inline-block w-2 h-2 rounded-full" :class="isPlaying && !isMuted ? 'bg-emerald-500 animate-ping' : 'bg-slate-400'"></span>
                <span class="text-[11px] font-bold tracking-wider uppercase text-amber-700 dark:text-amber-400">GSHotel Serenity</span>
            </div>
            <span class="block text-[10px] text-slate-500 dark:text-slate-400 font-medium" x-text="isPlaying ? (isMuted ? 'Audio Muted' : 'Relaxing Ambient Sound') : 'Click to Play Music'"></span>
        </div>

        <!-- Play / Pause Button -->
        <button type="button" @click="togglePlay()" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-amber-950/40 text-slate-700 dark:text-slate-200 flex items-center justify-center transition" :title="isPlaying ? 'Pause Ambient Music' : 'Play Ambient Music'">
            <template x-if="!isPlaying">
                <svg class="w-4 h-4 ml-0.5 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </template>
            <template x-if="isPlaying">
                <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </template>
        </button>

        <!-- Mute / Unmute Button -->
        <button type="button" @click="toggleMute()" class="w-9 h-9 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-700 dark:text-amber-400 flex items-center justify-center transition font-bold" :title="isMuted ? 'Unmute Audio' : 'Mute Audio'">
            <template x-if="!isMuted">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                </svg>
            </template>
            <template x-if="isMuted">
                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                </svg>
            </template>
        </button>

        <!-- Volume Slider (Slide-out on hover) -->
        <div class="hidden md:flex items-center">
            <input type="range" min="0" max="1" step="0.05" x-model="volume" @input="updateVolume()" class="w-16 h-1.5 bg-slate-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer accent-amber-600" title="Adjust Volume">
        </div>
    </div>
</div>

<script>
function gshotelMusicPlayer() {
    return {
        isPlaying: false,
        isMuted: false,
        volume: 0.35,
        audioCtx: null,
        gainNode: null,
        oscNodes: [],
        audioElement: null,
        synthInterval: null,

        initAudio() {
            // Check localStorage
            const savedMute = localStorage.getItem('gshotel_music_muted');
            if (savedMute !== null) {
                this.isMuted = savedMute === 'true';
            }

            // Create relaxing ambient HTML5 audio with calm royalty-free soundscape
            this.audioElement = new Audio('https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3?filename=relaxing-mountains-nature-walk-112191.mp3');
            this.audioElement.loop = true;
            this.audioElement.volume = this.isMuted ? 0 : this.volume;

            // Attempt gentle auto-play (browsers may require first user gesture)
            const playPromise = this.audioElement.play();
            if (playPromise !== undefined) {
                playPromise.then(() => {
                    this.isPlaying = true;
                }).catch(() => {
                    // Browser policy blocked immediate autoplay, wait for user click
                    this.isPlaying = false;
                    const resumeOnGesture = () => {
                        if (!this.isPlaying && !this.isMuted) {
                            this.audioElement.play().then(() => {
                                this.isPlaying = true;
                            }).catch(() => {});
                        }
                        window.removeEventListener('click', resumeOnGesture);
                    };
                    window.addEventListener('click', resumeOnGesture, { once: true });
                });
            }

            // If remote audio fails or is blocked, Web Audio API ambient chime synth fallback ensures music always works!
            this.audioElement.addEventListener('error', () => {
                this.setupSynthAmbience();
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
                    // Start Web Audio synth if audio file cannot play
                    this.setupSynthAmbience();
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

            if (this.gainNode) {
                this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : (this.volume * 0.15), this.audioCtx.currentTime);
            }

            if (!this.isPlaying && !this.isMuted) {
                this.togglePlay();
            }
        },

        updateVolume() {
            if (this.audioElement) {
                this.audioElement.volume = this.isMuted ? 0 : this.volume;
            }
            if (this.gainNode && this.audioCtx) {
                this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : (this.volume * 0.15), this.audioCtx.currentTime);
            }
        },

        setupSynthAmbience() {
            try {
                if (!this.audioCtx) {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    this.audioCtx = new AudioContext();
                    this.gainNode = this.audioCtx.createGain();
                    this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : 0.05, this.audioCtx.currentTime);
                    this.gainNode.connect(this.audioCtx.destination);
                }

                if (this.audioCtx.state === 'suspended') {
                    this.audioCtx.resume();
                }

                // Generates warm, calming ambient pentatonic chords (C major 9 / Fmaj9)
                const chords = [
                    [261.63, 329.63, 392.00, 493.88], // C, E, G, B
                    [220.00, 261.63, 329.63, 392.00], // A, C, E, G
                    [174.61, 220.00, 261.63, 329.63], // F, A, C, E
                    [196.00, 246.94, 293.66, 392.00], // G, B, D, G
                ];

                let chordIdx = 0;
                const playChord = () => {
                    if (!this.isPlaying || this.isMuted) return;
                    const chord = chords[chordIdx % chords.length];
                    chordIdx++;

                    chord.forEach(freq => {
                        const osc = this.audioCtx.createOscillator();
                        const noteGain = this.audioCtx.createGain();
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(freq, this.audioCtx.currentTime);

                        noteGain.gain.setValueAtTime(0, this.audioCtx.currentTime);
                        noteGain.gain.linearRampToValueAtTime(0.015, this.audioCtx.currentTime + 2);
                        noteGain.gain.exponentialRampToValueAtTime(0.0001, this.audioCtx.currentTime + 7.5);

                        osc.connect(noteGain);
                        noteGain.connect(this.gainNode);

                        osc.start();
                        osc.stop(this.audioCtx.currentTime + 8);
                    });
                };

                playChord();
                if (this.synthInterval) clearInterval(this.synthInterval);
                this.synthInterval = setInterval(playChord, 8000);
            } catch (e) {
                console.log('Ambient audio fallback initiated');
            }
        }
    };
}
</script>
