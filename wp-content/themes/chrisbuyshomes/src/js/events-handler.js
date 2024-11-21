// events-handler.js

document.addEventListener("DOMContentLoaded", () => {
  // Initialize the dataLayer if it hasn't been already
  window.dataLayer = window.dataLayer || [];

  // Track if the form has been interacted with for the first time
  let formInteractionTracked = new Set();

  // Click Events using Event Delegation
  document.addEventListener("click", (event) => {
    // Call Button Click
    const callButton = event.target.closest("a.call-btn");
    if (callButton) {
      const parentSection = callButton.closest("header, footer, section");
      const location = parentSection
        ? parentSection.id || parentSection.className
        : "unknown";

      dataLayer.push({
        event: "call_click",
        call_click_id: callButton.id,
        call_click_location: location,
        href: callButton.href,
      });
    }

    // CTA Button Click
    if (event.target.matches(".cta-btn")) {
      const parentSection = event.target.closest("section");
      const sectionName = parentSection
        ? parentSection.id || parentSection.className
        : "unknown";

      dataLayer.push({
        event: "cta_click",
        cta_text: event.target.innerText,
        cta_section_name: sectionName,
      });
    }

    // FAQ Item Click
    if (event.target.matches(".faq-question")) {
      dataLayer.push({
        event: "faq_click",
        faq_question: event.target.innerText,
      });
    }

    // Form Submit Button Click
    if (event.target.matches('form input[type="submit"]')) {
      const form = event.target.closest("form");
      dataLayer.push({
        event: "form_submit",
        form_id: form.id,
        form_name: form.name,
      });
    }
  });

  // Form Events using Event Delegation
  document.addEventListener(
    "focus",
    (event) => {
      if (
        event.target.matches(
          'form input:not([type="submit"], [type="radio"], [type="checkbox"]), form select, form textarea'
        )
      ) {
        const form = event.target.closest("form");
        const label = findLabel(event.target);
        const labelText = label ? label.innerText.trim() : "unknown";

        dataLayer.push({
          event: "form_field_focus",
          form_id: form.id,
          form_name: form.name,
          form_field_label: labelText,
        });

        // Trigger form_start on first interaction (keystroke) in the form
        if (!formInteractionTracked.has(form)) {
          event.target.addEventListener("input", () => {
            if (!formInteractionTracked.has(form)) {
              formInteractionTracked.add(form);
              dataLayer.push({
                event: "form_start",
                form_id: form.id,
                form_name: form.name,
              });
            }
          });
        }
      }
    },
    true
  ); // Use the capture phase to detect focus events reliably

  document.addEventListener(
    "blur",
    (event) => {
      if (
        event.target.matches(
          'form input:not([type="submit"], [type="radio"], [type="checkbox"]), form select, form textarea'
        )
      ) {
        const form = event.target.closest("form");
        const label = findLabel(event.target);
        const labelText = label ? label.innerText.trim() : "unknown";
        const fieldValue = event.target.value || "";

        dataLayer.push({
          event: "form_field_blur",
          form_id: form.id,
          form_name: form.name,
          form_field_label: labelText,
          // form_field_value: fieldValue,
        });
      }
    },
    true
  ); // Use the capture phase to detect blur events reliably

  // Initialize video tracking for Vimeo and YouTube
  initializeVideoTracking();
});

// Helper function to find the corresponding label for an input
function findLabel(inputElement) {
  // Check if the input has an ID
  if (inputElement.id) {
    // Find a label with a "for" attribute matching the input's ID
    return document.querySelector(`label[for="${inputElement.id}"]`);
  }

  // Check if the input is wrapped in a label element
  let parent = inputElement.parentElement;
  while (parent) {
    if (parent.tagName.toLowerCase() === "label") {
      return parent;
    }
    parent = parent.parentElement;
  }

  // Return null if no label is found
  return null;
}

/**
 * Initializes video tracking for both Vimeo and YouTube videos.
 */
function initializeVideoTracking() {
  const vimeoIframes = document.querySelectorAll('iframe[src*="vimeo.com"]');
  const youtubeIframes = document.querySelectorAll(
    'iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"]'
  );

  if (vimeoIframes.length > 0) {
    trackVimeoVideos(vimeoIframes);
  }

  if (youtubeIframes.length > 0) {
    trackYouTubeVideos(youtubeIframes);
  }
}

/**
 * Tracks Vimeo videos embedded on the page using the Vimeo Player API.
 * @param {NodeList} vimeoIframes - The list of Vimeo iframe elements.
 */
function trackVimeoVideos(vimeoIframes) {
  // Check if Vimeo Player API is available
  if (typeof Vimeo !== "undefined" && Vimeo.Player) {
    vimeoIframes.forEach((iframe) => {
      const player = new Vimeo.Player(iframe);

      let milestones = { 25: false, 100: false };

      // Retrieve video ID and title
      Promise.all([player.getVideoId(), player.getVideoTitle()]).then(
        ([videoId, videoTitle]) => {
          // Play Event
          player.on("play", () => {
            dataLayer.push({
              event: "video_play",
              video_id: videoId,
              video_name: videoTitle,
            });
          });

          // Timeupdate Event for milestones
          player.on("timeupdate", (data) => {
            player.getDuration().then((duration) => {
              const percentComplete = (data.seconds / duration) * 100;

              // 25% Completion
              if (!milestones[25] && percentComplete >= 25) {
                milestones[25] = true;
                dataLayer.push({
                  event: "video_milestone_25",
                  video_id: videoId,
                  video_name: videoTitle,
                });
              }

              // 100% Completion
              if (!milestones[100] && percentComplete >= 99) {
                milestones[100] = true;
                dataLayer.push({
                  event: "video_complete",
                  video_id: videoId,
                  video_name: videoTitle,
                });
              }
            });
          });
        }
      );
    });
  } else {
    console.warn("Vimeo Player API is not loaded.");
  }
}

/**
 * Tracks YouTube videos embedded on the page using the YouTube IFrame API.
 * @param {NodeList} youtubeIframes - The list of YouTube iframe elements.
 */
function trackYouTubeVideos(youtubeIframes) {
  // Load YouTube IFrame API if not already loaded
  if (typeof YT === "undefined" || typeof YT.Player === "undefined") {
    // Create a script tag to load the YouTube IFrame API
    var tag = document.createElement("script");
    tag.src = "https://www.youtube.com/iframe_api";
    tag.async = true;
    var firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  }

  // Array to hold YouTube player instances and their data
  let ytPlayers = [];

  // Function called when the YouTube API is ready
  window.onYouTubeIframeAPIReady = function () {
    youtubeIframes.forEach((iframe) => {
      const player = new YT.Player(iframe, {
        events: {
          onReady: onPlayerReady,
          onStateChange: onPlayerStateChange,
        },
      });
      ytPlayers.push({
        player: player,
        milestones: { played: false, 25: false, 100: false },
        checkingMilestones: false,
        videoId: null,
        videoTitle: null,
      });
    });
  };

  /**
   * Handles the player ready event for YouTube players.
   * @param {Object} event - The event object from YouTube API.
   */
  function onPlayerReady(event) {
    const player = event.target;
    const playerData = ytPlayers.find((p) => p.player === player);

    // Store video data
    const videoData = player.getVideoData();
    playerData.videoId = videoData.video_id;
    playerData.videoTitle = videoData.title;
  }

  /**
   * Handles the state change events of YouTube players.
   * @param {Object} event - The event object from YouTube API.
   */
  function onPlayerStateChange(event) {
    const playerData = ytPlayers.find((p) => p.player === event.target);

    // Ensure videoId and videoTitle are available
    if (!playerData.videoId || !playerData.videoTitle) {
      const videoData = event.target.getVideoData();
      playerData.videoId = videoData.video_id;
      playerData.videoTitle = videoData.title;
    }

    const videoId = playerData.videoId;
    const videoTitle = playerData.videoTitle;

    switch (event.data) {
      case YT.PlayerState.PLAYING:
        // Video Play Event
        if (!playerData.milestones.played) {
          playerData.milestones.played = true;
          dataLayer.push({
            event: "video_play",
            video_id: videoId,
            video_name: videoTitle,
          });
        }

        // Start checking for milestones if not already doing so
        if (!playerData.checkingMilestones) {
          playerData.checkingMilestones = true;
          checkYouTubeMilestones(event.target, playerData);
        }
        break;

      default:
        break;
    }
  }

  /**
   * Checks for milestone completions in YouTube videos.
   * @param {Object} player - The YouTube player instance.
   * @param {Object} playerData - The player data object from ytPlayers array.
   */
  function checkYouTubeMilestones(player, playerData) {
    const duration = player.getDuration();

    const interval = setInterval(() => {
      if (player.getPlayerState() !== YT.PlayerState.PLAYING) {
        clearInterval(interval);
        playerData.checkingMilestones = false;
        return;
      }

      const currentTime = player.getCurrentTime();
      const percentComplete = (currentTime / duration) * 100;

      // 25% Completion
      if (!playerData.milestones[25] && percentComplete >= 25) {
        playerData.milestones[25] = true;
        dataLayer.push({
          event: "video_milestone_25",
          video_id: playerData.videoId,
          video_name: playerData.videoTitle,
        });
      }

      // 100% Completion
      if (!playerData.milestones[100] && percentComplete >= 99) {
        playerData.milestones[100] = true;
        dataLayer.push({
          event: "video_complete",
          video_id: playerData.videoId,
          video_name: playerData.videoTitle,
        });
        // Stop checking milestones if 100% completion is reached
        clearInterval(interval);
        playerData.checkingMilestones = false;
      }

      // Stop checking if all milestones are reached
      if (playerData.milestones[25] && playerData.milestones[100]) {
        clearInterval(interval);
        playerData.checkingMilestones = false;
      }
    }, 1000);
  }
}
