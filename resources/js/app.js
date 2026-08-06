import './bootstrap';
import { initFlowbite } from 'flowbite';

window.initFlowbite = initFlowbite;

const reinit = () => {
    if (typeof initFlowbite === 'function') {
        initFlowbite();
    }
};

document.addEventListener('DOMContentLoaded', reinit);

document.addEventListener('livewire:initialized', () => {
    reinit();
    if (typeof Livewire !== 'undefined') {
        Livewire.hook('morph.updated', reinit);
        Livewire.hook('commit', reinit);
    }
});

document.addEventListener('livewire:navigated', reinit);

