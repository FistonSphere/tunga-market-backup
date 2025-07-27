module.exports = {
  content: ["./pages/*.{html,js}", "./index.html", "./js/*.js"],
  theme: {
    extend: {
      colors: {
        // Primary Colors - Deep navy for trust and global credibility
        primary: {
          50: "#e6f3ff", // primary-50
          100: "#b3d9ff", // primary-100
          200: "#80bfff", // primary-200
          300: "#4da6ff", // primary-300
          400: "#1a8cff", // primary-400
          500: "#1a365d", // primary-500 (main)
          600: "#153056", // primary-600
          700: "#10294f", // primary-700
          800: "#0b2248", // primary-800
          900: "#061b41", // primary-900
          DEFAULT: "#1a365d", // primary
        },
        
        // Secondary Colors - Sophisticated charcoal for content hierarchy
        secondary: {
          50: "#f7fafc", // gray-50
          100: "#edf2f7", // gray-100
          200: "#e2e8f0", // gray-200
          300: "#cbd5e0", // gray-300
          400: "#a0aec0", // gray-400
          500: "#718096", // gray-500
          600: "#4a5568", // gray-600
          700: "#2d3748", // gray-700 (main)
          800: "#1a202c", // gray-800
          900: "#171923", // gray-900
          DEFAULT: "#2d3748", // secondary
        },

        // Accent Colors - Energetic orange for key actions and growth
        accent: {
          50: "#fff5f0", // orange-50
          100: "#ffe6d9", // orange-100
          200: "#ffd6c2", // orange-200
          300: "#ffc7ab", // orange-300
          400: "#ffb794", // orange-400
          500: "#ff6b35", // orange-500 (main)
          600: "#e55a2b", // orange-600
          700: "#cc4921", // orange-700
          800: "#b23817", // orange-800
          900: "#99270d", // orange-900
          DEFAULT: "#ff6b35", // accent
        },

        // Background Colors
        background: "#f7fafc", // gray-50 - Clean canvas that reduces eye strain
        surface: "#edf2f7", // gray-100 - Subtle elevation for cards and sections

        // Text Colors
        text: {
          primary: "#1a202c", // gray-800 - High contrast for extended reading
          secondary: "#4a5568", // gray-600 - Clear hierarchy without harsh contrast
        },

        // Status Colors
        success: {
          50: "#f0fff4", // green-50
          100: "#c6f6d5", // green-100
          200: "#9ae6b4", // green-200
          300: "#68d391", // green-300
          400: "#48bb78", // green-400
          500: "#38a169", // green-500 (main)
          600: "#2f855a", // green-600
          700: "#276749", // green-700
          800: "#22543d", // green-800
          900: "#1c4532", // green-900
          DEFAULT: "#38a169", // success
        },

        warning: {
          50: "#fffbeb", // yellow-50
          100: "#fef3c7", // yellow-100
          200: "#fde68a", // yellow-200
          300: "#fcd34d", // yellow-300
          400: "#fbbf24", // yellow-400
          500: "#d69e2e", // yellow-500 (main)
          600: "#b7791f", // yellow-600
          700: "#975a16", // yellow-700
          800: "#78350f", // yellow-800
          900: "#451a03", // yellow-900
          DEFAULT: "#d69e2e", // warning
        },

        error: {
          50: "#fed7d7", // red-50
          100: "#feb2b2", // red-100
          200: "#fc8181", // red-200
          300: "#f56565", // red-300
          400: "#e53e3e", // red-400 (main)
          500: "#c53030", // red-500
          600: "#9b2c2c", // red-600
          700: "#742a2a", // red-700
          800: "#4a1717", // red-800
          900: "#2d0909", // red-900
          DEFAULT: "#e53e3e", // error
        },

        // Border Colors
        border: "#e2e8f0", // gray-200 - Minimal borders for form inputs and data tables
        "border-accent": "#ff6b35", // accent - 2px accent borders for active states
      },

      fontFamily: {
        sans: ['Inter', 'sans-serif'], // Modern clarity for headlines and body
        inter: ['Inter', 'sans-serif'], // Explicit Inter font
        accent: ['Playfair Display', 'serif'], // Sophisticated serif for editorial content
        playfair: ['Playfair Display', 'serif'], // Explicit Playfair font
      },

      fontSize: {
        'hero': ['3.5rem', { lineHeight: '1.1', fontWeight: '700' }], // 56px
        'display': ['3rem', { lineHeight: '1.2', fontWeight: '600' }], // 48px
        'heading': ['2.25rem', { lineHeight: '1.3', fontWeight: '600' }], // 36px
        'subheading': ['1.5rem', { lineHeight: '1.4', fontWeight: '500' }], // 24px
        'body-lg': ['1.125rem', { lineHeight: '1.6', fontWeight: '400' }], // 18px
        'body': ['1rem', { lineHeight: '1.6', fontWeight: '400' }], // 16px
        'body-sm': ['0.875rem', { lineHeight: '1.5', fontWeight: '400' }], // 14px
        'caption': ['0.75rem', { lineHeight: '1.4', fontWeight: '400' }], // 12px
      },

      boxShadow: {
        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1)', // Subtle depth for cards
        'modal': '0 10px 15px -3px rgba(0, 0, 0, 0.1)', // Stronger shadows for modals
        'hover': '0 8px 12px -2px rgba(0, 0, 0, 0.1)', // Hover state shadow
      },

      borderWidth: {
        '1': '1px', // Minimal borders
        '2': '2px', // Accent borders
      },

      transitionDuration: {
        '300': '300ms', // Fast transitions for state changes
        '600': '600ms', // Slow transitions for page transitions
      },

      transitionTimingFunction: {
        'ease-in-out': 'ease-in-out', // Smooth transitions
      },

      spacing: {
        '18': '4.5rem', // 72px
        '88': '22rem', // 352px
        '128': '32rem', // 512px
      },

      maxWidth: {
        '8xl': '88rem', // 1408px
        '9xl': '96rem', // 1536px
      },

      animation: {
        'fade-in': 'fadeIn 0.3s ease-in-out',
        'slide-up': 'slideUp 0.6s ease-in-out',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },

      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },
  },
  plugins: [],
}