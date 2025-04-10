// src/eventBus.js
import { reactive } from 'vue';

const listeners = reactive(new Map());

const on = (event, callback) => {
  if (!listeners.has(event)) {
    listeners.set(event, []);
  }
  listeners.get(event).push(callback);
};

const off = (event, callback) => {
  if (listeners.has(event)) {
    const idx = listeners.get(event).indexOf(callback);
    if (idx !== -1) listeners.get(event).splice(idx, 1);
  }
};

const emit = (event, payload) => {
  if (listeners.has(event)) {
    listeners.get(event).forEach(callback => callback(payload));
  }
};

export default {
  on,
  off,
  emit
};
