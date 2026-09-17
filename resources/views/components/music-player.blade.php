<div x-data="gshotelMusicPlayer()" x-init="initAudio()" class="inline-flex items-center">
    <!-- Ultra-Minimal Header Sound Controller (Play/Pause + Volume Only) -->
    <div class="flex items-center gap-2 bg-slate-100/90 dark:bg-slate-800/90 px-3 py-1.5 rounded-full border border-slate-200/80 dark:border-slate-700 shadow-sm transition-all hover:border-amber-500/40">
        
        <!-- Play / Pause Button -->
        <button type="button" 
                @click="togglePlay()" 
                class="w-7 h-7 rounded-full bg-amber-500/15 hover:bg-amber-500/25 text-amber-700 dark:text-amber-400 flex items-center justify-center transition-all duration-200 hover:scale-110 active:scale-95" 
                :title="isPlaying ? 'Pause' : 'Play'">
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

        <!-- Volume Icon & Slider -->
        <div class="flex items-center gap-1.5">
            <button type="button" 
                    @click="toggleMute()" 
                    class="text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white transition flex items-center justify-center" 
                    :title="isMuted ? 'Unmute' : 'Mute'">
                <template x-if="!isMuted && volume > 0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                    </svg>
                </template>
                <template x-if="isMuted || volume == 0">
                    <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                    </svg>
                </template>
            </button>

            <!-- Minimal Volume Slider -->
            <input type="range" 
                   min="0" 
                   max="1" 
                   step="0.05" 
                   x-model="volume" 
                   @input="updateVolume()" 
                   class="w-14 sm:w-16 h-1 bg-slate-300 dark:bg-slate-600 rounded-lg appearance-none cursor-pointer accent-amber-600" 
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

        // Deeply relaxing serene ambient meditation soundscapes
        primaryTrackUrl: '/audio/meditation_ambient.mp3',
        fallbackTrackUrl: '/audio/relaxing_sanctuary.ogg',

        initAudio() {
            const savedMute = localStorage.getItem('gshotel_music_muted');
            if (savedMute !== null) {
                this.isMuted = savedMute === 'true';
            }

            const savedVol = localStorage.getItem('gshotel_music_volume');
            if (savedVol !== null) {
                this.volume = parseFloat(savedVol);
            }

            this.audioElement = new Audio(this.primaryTrackUrl);
            this.audioElement.loop = true;
            this.audioElement.volume = this.isMuted ? 0 : this.volume;
            this.audioElement.muted = this.isMuted;

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
            window.addEventListener('start-gshotel-music', () => {
                if (!this.isPlaying) {
                    this.playAudio();
                }
            });
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

                // Warm, peaceful harmonic chord frequencies (F major 7 / D minor 9 meditation tones)
                const chords = [
                    [174.61, 220.00, 261.63, 329.63], // Fmaj7 warm pad
                    [146.83, 220.00, 261.63, 349.23], // Dm7 serene pad
                    [196.00, 246.94, 293.66, 392.00], // G gentle pad
                    [164.81, 207.65, 246.94, 329.63]  // E calm pad
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
