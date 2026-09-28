<div x-data="gshotelMusicPlayer()" x-init="initAudio()" class="inline-flex items-center shrink-0">
    <!-- Header Sound Controller with Purrple Cat - Equinox Title -->
    <div class="flex items-center gap-1 sm:gap-2 bg-slate-900/95 px-1.5 sm:px-3 py-1 sm:py-1.5 rounded-full border border-amber-500/30 shadow-md backdrop-blur-md transition-all hover:border-amber-500/50">
        
        <!-- Play / Pause Button -->
        <button type="button" 
                @click="togglePlay()" 
                class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95 flex-shrink-0" 
                :title="isPlaying ? 'Pause: Purrple Cat - Equinox' : 'Play: Purrple Cat - Equinox'">
            <template x-if="!isPlaying">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </template>
            <template x-if="isPlaying">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </template>
        </button>

        <!-- Track Title & Soundwave Indicator -->
        <div class="hidden md:flex items-center gap-1 sm:gap-1.5 cursor-pointer select-none max-w-[100px] xs:max-w-[140px] sm:max-w-none truncate" @click="togglePlay()" title="Purrple Cat - Equinox">
            <span class="text-[10px] sm:text-xs font-medium text-slate-200 truncate">
                <span class="hidden lg:inline">Purrple Cat - </span><span class="text-amber-400 font-semibold">Equinox</span>
            </span>
            <div class="flex items-center gap-0.5 h-3 px-0.5 flex-shrink-0">
                <span class="w-0.5 bg-amber-500 rounded-full transition-all duration-200" :class="isPlaying && !isMuted ? 'h-3 animate-pulse' : 'h-1 opacity-30'"></span>
                <span class="w-0.5 bg-amber-400 rounded-full transition-all duration-200" :class="isPlaying && !isMuted ? 'h-2 animate-bounce' : 'h-1 opacity-30'" style="animation-delay: 150ms"></span>
                <span class="w-0.5 bg-amber-600 rounded-full transition-all duration-200" :class="isPlaying && !isMuted ? 'h-2.5 animate-pulse' : 'h-1 opacity-30'" style="animation-delay: 300ms"></span>
            </div>
        </div>

        <div class="hidden md:block h-3 w-px bg-slate-700/80 mx-0.5 flex-shrink-0"></div>

        <!-- Volume Icon & Slider -->
        <div class="flex items-center gap-1 sm:gap-1.5 flex-shrink-0">
            <button type="button" 
                    @click="toggleMute()" 
                    class="w-5 h-5 sm:w-6 sm:h-6 text-slate-400 hover:text-white transition flex items-center justify-center flex-shrink-0" 
                    :title="isMuted ? 'Unmute' : 'Mute'">
                <template x-if="!isMuted && volume > 0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                    </svg>
                </template>
                <template x-if="isMuted || volume == 0">
                    <svg class="w-3.5 h-3.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                    </svg>
                </template>
            </button>

            <!-- Minimal Volume Slider (visible on lg+ screens) -->
            <input type="range" 
                   min="0" 
                   max="1" 
                   step="0.05" 
                   x-model="volume" 
                   @input="updateVolume()" 
                   class="hidden lg:block w-12 sm:w-16 h-1 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-amber-500" 
                   title="Volume">
        </div>

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

        // Purrple Cat - Equinox (CC BY-SA 3.0)
        primaryTrackUrl: '{{ asset('audio/purrple-cat-equinox.mp3') }}',
        fallbackTrackUrl: '{{ asset('audio/meditation_ambient.mp3') }}',

        initAudio() {
            const savedMute = localStorage.getItem('gshotel_music_muted');
            if (savedMute !== null) {
                this.isMuted = savedMute === 'true';
            }

            const savedVol = localStorage.getItem('gshotel_music_volume');
            if (savedVol !== null) {
                this.volume = parseFloat(savedVol);
            }

            if (!window.__gshotel_audio_instance) {
                window.__gshotel_audio_instance = new Audio(this.primaryTrackUrl);
                window.__gshotel_audio_instance.loop = true;
            }
            this.audioElement = window.__gshotel_audio_instance;
            this.audioElement.volume = this.isMuted ? 0 : this.volume;
            this.audioElement.muted = this.isMuted;
            this.isPlaying = !this.audioElement.paused && this.audioElement.currentTime > 0;

            this.audioElement.onplay = () => { this.isPlaying = true; };
            this.audioElement.onpause = () => { this.isPlaying = false; };

            this.audioElement.addEventListener('error', () => {
                if (this.audioElement.src !== window.location.origin + this.fallbackTrackUrl) {
                    this.audioElement.src = this.fallbackTrackUrl;
                    if (this.isPlaying) {
                        this.audioElement.play().catch(() => this.setupAmbientSynth());
                    }
                } else {
                    this.setupAmbientSynth();
                }
            });

            // Listen for external play trigger (e.g. from welcome screen button)
            if (!window.__gshotel_music_listener_attached) {
                window.__gshotel_music_listener_attached = true;
                window.addEventListener('start-gshotel-music', () => {
                    if (this.audioElement && this.audioElement.paused) {
                        this.playAudio();
                    }
                });
            }
        },

        playAudio() {
            if (!this.audioElement) {
                this.initAudio();
            }

            this.audioElement.muted = this.isMuted;
            this.audioElement.volume = this.isMuted ? 0 : this.volume;

            this.audioElement.play().then(() => {
                this.isPlaying = true;
            }).catch(() => {
                this.setupAmbientSynth();
                this.isPlaying = true;
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
                this.playAudio();
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
                this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : (this.volume * 0.05), this.audioCtx.currentTime);
            }

            if (!this.isPlaying && !this.isMuted) {
                this.playAudio();
            }
        },

        updateVolume() {
            this.isMuted = this.volume == 0;
            localStorage.setItem('gshotel_music_volume', this.volume);
            localStorage.setItem('gshotel_music_muted', this.isMuted);

            if (this.audioElement) {
                this.audioElement.muted = this.isMuted;
                this.audioElement.volume = this.isMuted ? 0 : this.volume;
            }

            if (this.gainNode && this.audioCtx) {
                this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : (this.volume * 0.05), this.audioCtx.currentTime);
            }

            if (!this.isPlaying && this.volume > 0) {
                this.playAudio();
            }
        },

        setupAmbientSynth() {
            try {
                if (!this.audioCtx) {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    this.audioCtx = new AudioContext();
                    this.gainNode = this.audioCtx.createGain();
                    this.gainNode.gain.setValueAtTime(this.isMuted ? 0 : (this.volume * 0.035), this.audioCtx.currentTime);
                    this.gainNode.connect(this.audioCtx.destination);
                }

                if (this.audioCtx.state === 'suspended') {
                    this.audioCtx.resume();
                }

                // Warm, peaceful harmonic chord frequencies (Lofi chill ambient tones)
                const chords = [
                    [174.61, 220.00, 261.63, 329.63], // Fmaj7
                    [146.83, 220.00, 261.63, 349.23], // Dm7
                    [196.00, 246.94, 293.66, 392.00], // G
                    [164.81, 207.65, 246.94, 329.63]  // E
                ];

                let chordIdx = 0;
                const playAmbientDrone = () => {
                    if (!this.isPlaying || this.isMuted) return;
                    const chord = chords[chordIdx % chords.length];
                    chordIdx++;

                    chord.forEach((freq) => {
                        const osc = this.audioCtx.createOscillator();
                        const noteGain = this.audioCtx.createGain();

                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(freq, this.audioCtx.currentTime);

                        noteGain.gain.setValueAtTime(0, this.audioCtx.currentTime);
                        noteGain.gain.linearRampToValueAtTime(0.012, this.audioCtx.currentTime + 3.0);
                        noteGain.gain.exponentialRampToValueAtTime(0.0001, this.audioCtx.currentTime + 8.5);

                        osc.connect(noteGain);
                        noteGain.connect(this.gainNode);

                        osc.start();
                        osc.stop(this.audioCtx.currentTime + 9.0);
                    });
                };

                playAmbientDrone();
                if (this.synthInterval) clearInterval(this.synthInterval);
                this.synthInterval = setInterval(playAmbientDrone, 7500);
            } catch (e) {
                console.log('Ambient sound generator active');
            }
        }
    };
}
</script>
