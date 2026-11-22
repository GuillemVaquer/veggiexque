export default function welcomeEffect() {
    const sentence = document.getElementById('sentence');
    const duration = 1500; // ms for each colour transition

    sentence.style.transition = `color ${duration}ms linear`;

    // 1. Fade from #aab978 (background colour) to white
    sentence.style.color = '#ffffff';

    setTimeout(() => {
        // 2. Stay white for 3 seconds, then fade back
        sentence.style.color = '#aab978';

        setTimeout(() => {
        // Lock the current height and prepare the transition
        sentence.style.height = sentence.offsetHeight + 'px';
        sentence.style.overflow = 'hidden';
        sentence.style.transition = 'height 1500ms linear';

        // Force the browser to compute styles for the locked height
        void sentence.offsetHeight;

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                sentence.style.height = '0px';
            });
        });
    }, duration);
    }, duration + 2000);
}
