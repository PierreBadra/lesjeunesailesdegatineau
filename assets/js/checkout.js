// Application state
let currentStep = 1;
let isProcessing = false;
let children = [];
let programAvailability = {}; // Track available spots for each program

// Order items (sample data)
const orderItems = checkoutData.orderItems;
// [
//   {
//     id: "1",
//     name: "Semaine 1 - Programme de perfectionnement avancé",
//     price: 180,
//     quantity: 1,
//     programId: "semaine1-perfectionnement-avance",
//     programName: "Semaine 1 - Programme de perfectionnement avancé",
//     startDate: "30 juin 2025",
//     endDate: "4 juillet 2025",
//   },
//   {
//     id: "2",
//     name: "Semaine 2 - Programme de perfectionnement avancé",
//     price: 220,
//     quantity: 1,
//     programId: "semaine2-perfectionnement-avance",
//     programName: "Semaine 2 - Programme de perfectionnement avancé",
//     startDate: "7 juillet 2025",
//     endDate: "11 juillet 2025",
//   },
//   {
//     id: "3",
//     name: "Semaine 3 - Programme de perfectionnement avancé",
//     price: 220,
//     quantity: 2,
//     programId: "semaine3-perfectionnement-avance",
//     programName: "Semaine 3 - Programme de perfectionnement avancé",
//     startDate: "14 juillet 2025",
//     endDate: "18 juillet 2025",
//   },
// ];

// Initialize program availability tracking
function initializeProgramAvailability() {
  programAvailability = {};
  orderItems.forEach((item) => {
    programAvailability[item.programId] = {
      total: item.quantity,
      available: item.quantity,
      selected: 0,
    };
  });
}

// Update program availability when checkbox is changed
function updateProgramAvailability(childId, programId, isChecked) {
  if (!programAvailability[programId]) return;

  const childIndex = children.findIndex((c) => c.id === childId);
  if (childIndex === -1) return;

  const child = children[childIndex];
  if (!child.programs) child.programs = [];

  const programIndex = child.programs.indexOf(programId);

  if (isChecked && programIndex === -1) {
    // Adding program to child
    if (programAvailability[programId].available > 0) {
      child.programs.push(programId);
      programAvailability[programId].selected++;
      programAvailability[programId].available--;
    } else {
      // Uncheck the checkbox if no spots available
      const checkbox = document.getElementById(
        `child-${childId}-program-${programId}`
      );
      if (checkbox) checkbox.checked = false;
      return;
    }
  } else if (!isChecked && programIndex !== -1) {
    // Removing program from child
    child.programs.splice(programIndex, 1);
    programAvailability[programId].selected--;
    programAvailability[programId].available++;
  }

  // Update all program displays
  updateAllProgramDisplays();

  // Update allocation status (optional)
  updateProgramAllocationStatus();

  // Clear any existing allocation error messages when changes are made
  $(".allocation-error-message").remove();

  // Re-validate the child's date of birth if it exists
  // This provides immediate feedback when programs are changed
  const dobField = document.getElementById(`child-${childId}-dateOfBirth`);
  if (dobField && dobField.value) {
    // Small delay to ensure UI is updated first
    setTimeout(() => {
      validateField(`child-${childId}-dateOfBirth`);
    }, 100);
  }
}
// Update all program availability displays
function updateAllProgramDisplays() {
  const maxChildren = getMaxChildren();

  // Update displays for all children and all programs
  Object.keys(programAvailability).forEach((programId) => {
    for (let childId = 1; childId <= maxChildren; childId++) {
      updateProgramDisplay(childId, programId);
    }
  });
}

// Helper function to restore click handlers
function restoreContainerClickHandler(container, checkbox) {
  // Remove any existing listeners by cloning (if needed)
  const newContainer = container.cloneNode(true);
  container.parentNode.replaceChild(newContainer, container);

  // Get the new checkbox reference
  const newCheckbox = newContainer.querySelector('input[type="checkbox"]');

  // Add click event listener to container
  newContainer.addEventListener("click", function (e) {
    if (e.target !== newCheckbox && !newCheckbox.disabled) {
      e.preventDefault();
      e.stopPropagation();
      newCheckbox.click();
    }
  });

  // Add change event listener to checkbox - FIXED VERSION
  newCheckbox.addEventListener("change", function (e) {
    e.stopPropagation();
    const isChecked = e.target.checked;
    const programId = e.target.dataset.programId;
    const childId = parseInt(e.target.dataset.childId);

    // Get the current container reference (not the stale one)
    const currentContainer = e.target.closest("[data-program-container]");
    if (currentContainer) {
      currentContainer.classList.remove("border-red-500");
    }

    updateProgramAvailability(childId, programId, isChecked);
  });

  // Prevent checkbox click from bubbling
  newCheckbox.addEventListener("click", function (e) {
    e.stopPropagation();
  });
}

// Update individual program display
function updateProgramDisplay(childId, programId) {
  const checkbox = document.getElementById(
    `child-${childId}-program-${programId}`
  );
  const container = checkbox?.closest(".relative");
  const availabilitySpan = container?.querySelector(".availability-indicator");

  if (!checkbox || !container || !availabilitySpan) return;

  const availability = programAvailability[programId];
  const isChecked = checkbox.checked;

  // Update availability text and styling
  availabilitySpan.textContent = `${availability.available}/${availability.total} places`;

  if (availability.available === 0 && !isChecked) {
    // Program is full and this child doesn't have it selected
    availabilitySpan.textContent = "Complet";
    availabilitySpan.className =
      "availability-indicator text-xs px-2 py-1 rounded-full bg-red-100 text-red-800";

    // Disable the entire container
    container.classList.add("opacity-50", "cursor-not-allowed");
    container.classList.remove(
      "hover:bg-gray-50",
      "hover:border-gray-400",
      "cursor-pointer",
      "border-red-500"
    );
    checkbox.disabled = true;

    // Remove click handler by cloning the element
    const newContainer = container.cloneNode(true);
    container.parentNode.replaceChild(newContainer, container);

    // Update the checkbox reference to point to the new element
    const newCheckbox = newContainer.querySelector('input[type="checkbox"]');
    newCheckbox.disabled = true;
  } else {
    // Program has spots available or this child has it selected
    availabilitySpan.className =
      "availability-indicator text-xs px-2 py-1 rounded-full bg-green-100 text-green-800";

    // Enable the container
    container.classList.remove("opacity-50", "cursor-not-allowed");
    container.classList.add(
      "hover:bg-gray-50",
      "hover:border-gray-400",
      "cursor-pointer"
    );
    checkbox.disabled = false;

    // Get the current container reference (in case it was cloned)
    const currentContainer = document
      .getElementById(`child-${childId}-program-${programId}`)
      ?.closest(".relative");
    const currentCheckbox = document.getElementById(
      `child-${childId}-program-${programId}`
    );

    if (currentContainer && currentCheckbox) {
      // Remove any existing event listeners by cloning
      const newContainer = currentContainer.cloneNode(true);
      currentContainer.parentNode.replaceChild(newContainer, currentContainer);

      // Get references to the new elements
      const newCheckbox = newContainer.querySelector('input[type="checkbox"]');

      // Add fresh event listeners
      addEventListenersToSingleCheckbox(newCheckbox, newContainer);
    }
  }
}

// New helper function to add event listeners to a single checkbox
function addEventListenersToSingleCheckbox(checkbox, container) {
  if (!checkbox || !container) return;

  // Add change event listener to checkbox
  checkbox.addEventListener("change", function (e) {
    e.stopPropagation();
    const isChecked = e.target.checked;
    const programId = e.target.dataset.programId;
    const childId = parseInt(e.target.dataset.childId);

    container.classList.remove("border-red-500");
    updateProgramAvailability(childId, programId, isChecked);
  });

  // Add click event listener to container
  container.addEventListener("click", function (e) {
    if (e.target !== checkbox && !checkbox.disabled) {
      e.preventDefault();
      checkbox.click();
    }
  });

  // Prevent checkbox click from bubbling
  checkbox.addEventListener("click", function (e) {
    e.stopPropagation();
  });
}

// Calculate totals
function calculateTotals() {
  const subtotal = orderItems.reduce(
    (sum, item) => sum + item.price * item.quantity,
    0
  );
  const tps = subtotal * 0.05;
  const tvq = subtotal * 0.09975;
  const total = subtotal + tps + tvq;

  return { subtotal, tps, tvq, total };
}

// Update order summary
function updateOrderSummary() {
  const orderItemsContainer = document.getElementById("order-items");
  const { subtotal, tps, tvq, total } = calculateTotals();

  // Update order items
  orderItemsContainer.innerHTML = orderItems
    .map(
      (item) => `
      <div class="flex justify-between items-start">
			<div class="flex-grow">
				<h4 class="font-medium font-[Inter] text-gray-900 text-sm">${item.name}</h4>
				<span class="text-sm font-medium text-gray-600">× ${item.quantity}</span>
			</div>
			<div class="text-sm font-medium text-gray-900">$${(
        item.price * item.quantity
      ).toFixed(2)}</div>
		</div>
	`
    )
    .join("");

  // Update totals
  document.getElementById("subtotal").textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById("tps").textContent = `$${tps.toFixed(2)}`;
  document.getElementById("tvq").textContent = `$${tvq.toFixed(2)}`;
  document.getElementById("total").textContent = `$${total.toFixed(2)} CAD`;
}

// Get unique programs
function getUniquePrograms() {
  const uniquePrograms = [];
  const seen = new Set();

  orderItems.forEach((item) => {
    if (!seen.has(item.programId)) {
      uniquePrograms.push({
        ...item,
      });
      seen.add(item.programId);
    }
  });

  return uniquePrograms;
}

// Get max children
function getMaxChildren() {
  return Math.max(...orderItems.map((item) => item.quantity));
}

// Update step indicators
function updateStepIndicators() {
  for (let i = 1; i <= 3; i++) {
    const indicator = document.getElementById(`step${i}-indicator`);
    const progress = document.getElementById(`progress${i}`);

    if (i < currentStep) {
      indicator.className =
        "w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-green-600 text-white";
      indicator
        .querySelector(".lucide-circle-check-big")
        .classList.remove("hidden");
      document
        .getElementById(`step${i}-indicator-icon`)
        .classList.add("hidden");
      if (progress)
        progress.className =
          "flex-1 h-1 mx-4 transition-all duration-300 bg-green-600";
    } else if (i === currentStep) {
      indicator.className =
        "w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-blue-600 text-white";
      indicator
        .querySelector(".lucide-circle-check-big")
        .classList.add("hidden");
      document
        .getElementById(`step${i}-indicator-icon`)
        .classList.remove("hidden");
      if (progress)
        progress.className =
          "flex-1 h-1 mx-4 transition-all duration-300 bg-gray-200";
    } else {
      indicator.className =
        "w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-gray-200 text-gray-600";
      if (progress)
        progress.className =
          "flex-1 h-1 mx-4 transition-all duration-300 bg-gray-200";
    }
  }

  // Update progress bar
  const progressBar = document.getElementById("progress-bar");
  if (progressBar) {
    progressBar.style.width = `${((currentStep - 1) / 2) * 100}%`;
  }

  // Update step display
  document.getElementById("current-step-display").textContent = currentStep;

  // Show/hide steps
  for (let i = 1; i <= 3; i++) {
    const stepElement = document.getElementById(`step${i}`);
    if (stepElement) {
      stepElement.style.display = i === currentStep ? "block" : "none";
    }
  }
}

// Navigate to next step
function nextStep() {
  if (isProcessing || currentStep >= 3) return;

  // Validate current step before proceeding
  if (!validateCurrentStep()) {
    return;
  }

  const currentStepDiv = document.getElementById(`step${currentStep}`);
  const nextStepDiv = document.getElementById(`step${currentStep + 1}`);

  // Slide current step out to the left
  currentStepDiv.classList.remove("translate-x-0", "opacity-100");
  currentStepDiv.classList.add("-translate-x-4", "opacity-0");

  // Prepare next step (positioned to the right)
  requestAnimationFrame(() => {
    nextStepDiv.classList.remove(
      "translate-x-4",
      "opacity-0",
      "pointer-events-none"
    );
    nextStepDiv.classList.add(
      "translate-x-0",
      "opacity-100",
      "pointer-events-auto"
    );

    window.scrollTo({ top: 0, behavior: "smooth" });
  });
  currentStep++;

  if (currentStep === 2) {
    generateAllChildrenForms();
  }

  updateStepIndicators();
}

// Navigate to previous step
function prevStep() {
  if (isProcessing || currentStep <= 1) return;

  const currentStepDiv = document.getElementById(`step${currentStep}`);
  const prevStepDiv = document.getElementById(`step${currentStep - 1}`);

  // Slide current step out to the right
  currentStepDiv.classList.remove("translate-x-0", "opacity-100");
  currentStepDiv.classList.add(
    "translate-x-4",
    "opacity-0",
    "pointer-events-none"
  );

  // Slide previous step in from the left
  requestAnimationFrame(() => {
    prevStepDiv.classList.remove("-translate-x-4", "pointer-events-none");
    prevStepDiv.classList.add(
      "translate-x-0",
      "opacity-100",
      "pointer-events-auto"
    );

    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  currentStep--;
  updateStepIndicators();
}

// Validate current step
function validateCurrentStep() {
  switch (currentStep) {
    case 1:
      return validateContactInfo();
    case 2:
      // Validate both children info AND program allocation
      const childrenValid = validateChildrenInfo();
      const allocationValid = validateProgramAllocation();
      return childrenValid && allocationValid;
    case 3:
      return true;
    default:
      return true;
  }
}

function validateProgramAllocation() {
  let isValid = true;
  const unallocatedPrograms = [];

  // Check each program's availability
  Object.keys(programAvailability).forEach((programId) => {
    const availability = programAvailability[programId];
    if (availability.available > 0) {
      isValid = false;
      // Find the program name for better error messaging
      const program = orderItems.find((item) => item.programId === programId);
      if (program) {
        unallocatedPrograms.push({
          programId: program.programId,
          name: program.programName,
          remaining: availability.available,
        });
      }
    }
  });

  // Display error message if validation fails
  if (!isValid) {
    // Remove any existing allocation error messages
    $(".allocation-error-message").remove();

    // Create error message
    const errorMessage = document.createElement("div");
    errorMessage.className =
      "allocation-error-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4";

    const errorTitle = document.createElement("div");
    errorTitle.className = "font-medium mb-2";
    errorTitle.textContent = "Tous les programmes doivent être assignés";

    const errorDetails = document.createElement("div");
    errorDetails.className = "text-sm";

    if (unallocatedPrograms.length === 1) {
      errorDetails.textContent = `Il reste ${unallocatedPrograms[0].remaining} place(s) non assignée(s) pour "${unallocatedPrograms[0].name}".`;
    } else {
      errorDetails.innerHTML =
        'Les programmes suivants ont des places non assignées:<ul class="list-disc list-inside mt-1">' +
        unallocatedPrograms
          .map(
            (prog) =>
              `<li>${prog.name}: ${prog.remaining} place(s) restante(s)</li>`
          )
          .join("") +
        "</ul>";
    }

    errorMessage.appendChild(errorTitle);
    errorMessage.appendChild(errorDetails);

    // Insert error message at the top of the children container
    const childrenContainer = document.getElementById("children-container");
    if (childrenContainer) {
      childrenContainer.insertBefore(
        errorMessage,
        childrenContainer.firstChild
      );

      // Scroll to the error message
      errorMessage.scrollIntoView({ behavior: "smooth", block: "center" });
    }

    // Highlight unallocated program parents
    unallocatedPrograms.forEach((prog) => {
      const els = document.querySelectorAll(
        `[data-program-container="${prog.programId}"]`
      );
      if (els) {
        els.forEach((el) => {
          el.classList.add("border-red-500");
        });
      }
    });
  } else {
    // Remove any existing allocation error messages if validation passes
    $(".allocation-error-message").remove();

    unallocatedPrograms.forEach((prog) => {
      const els = document.querySelectorAll(
        `[data-program-container="${prog.programId}"]`
      );
      if (els) {
        els.forEach((el) => {
          el.classList.remove("border-red-500");
        });
      }
    });
  }

  return isValid;
}

// Validate contact information
function validateContactInfo() {
  let isValid = true;

  const fields = ["firstName", "lastName", "email", "phone"];
  fields.forEach((field) => {
    if (!validateField(field)) {
      isValid = false;
    }
  });

  return isValid;
}

// Validate children information
function validateChildrenInfo() {
  let isValid = true;
  const maxChildren = getMaxChildren();

  // Remove previous error messages and error classes
  $(".child-error-message").remove();
  $(".border-red-500").removeClass("border-red-500");

  for (let i = 1; i <= maxChildren; i++) {
    // Validate First Name, Last Name, and Date of Birth
    if (!validateField(`child-${i}-firstName`)) isValid = false;
    if (!validateField(`child-${i}-lastName`)) isValid = false;
    if (!validateField(`child-${i}-dateOfBirth`)) isValid = false;
  }

  return isValid;
}

function generateAllChildrenForms() {
  const container = document.getElementById("children-container");
  if (!container) return;

  container.innerHTML = "";
  const maxChildren = getMaxChildren();
  const programs = getUniquePrograms();

  // Generate forms for all children slots
  for (let i = 1; i <= maxChildren; i++) {
    const childData = children.find((c) => c.id === i) || { programs: [] };
    generateChildForm(i, childData, programs, maxChildren);
  }

  // Update all program displays after generating forms
  setTimeout(() => {
    updateAllProgramDisplays();
  }, 100); // Small delay to ensure DOM is ready
}

function updateProgramAllocationStatus() {
  // Add this to your program display to show allocation status
  const statusContainer = document.getElementById("allocation-status");
  if (!statusContainer) return;

  const statusHTML = Object.keys(programAvailability)
    .map((programId) => {
      const availability = programAvailability[programId];
      const program = orderItems.find((item) => item.programId === programId);

      if (!program) return "";

      const isFullyAllocated = availability.available === 0;
      const statusClass = isFullyAllocated
        ? "bg-green-100 text-green-800"
        : "bg-yellow-100 text-yellow-800";
      const statusText = isFullyAllocated
        ? "Complet"
        : `${availability.available} place(s) restante(s)`;

      return `
			<div class="flex items-center justify-between p-3 rounded-lg border ${
        isFullyAllocated ? "border-green-200" : "border-yellow-200"
      }">
				<span class="font-medium text-gray-900">${program.programName}</span>
				<span class="text-xs px-2 py-1 rounded-full ${statusClass}">${statusText}</span>
			</div>
		`;
    })
    .join("");

  statusContainer.innerHTML = `
		<div class="bg-white p-4 rounded-lg border border-gray-200">
			<h4 class="font-medium text-gray-900 mb-3">État d'allocation des programmes</h4>
			<div class="space-y-2">
				${statusHTML}
			</div>
		</div>
	`;
}

// Generate children forms
function generateChildForm(childId, childData, programs, maxChildren) {
  const container = document.getElementById("children-container");
  if (!container) return;

  const childForm = document.createElement("div");
  childForm.id = `child-form-${childId}`;
  childForm.className = "bg-white p-6 rounded-lg border border-gray-200";
  childForm.innerHTML = `
		<h3 class="font-bold bg-gradient-to-r transition-colors duration-200 gradient-animate from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest text-lg mb-4">Enfant ${childId}</h3>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
			<div>
				<label for="child-${childId}-firstName" class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">Prénom <span class="text-red-500">*</span></label>
				<input type="text" id="child-${childId}-firstName" value="${
    childData.firstName || ""
  }" 
					class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors">
			</div>
			<div>
				<label for="child-${childId}-lastName" class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">Nom de famille <span class="text-red-500">*</span></label>
				<input type="text" id="child-${childId}-lastName" value="${
    childData.lastName || ""
  }" 
					class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors">
			</div>
		</div>
		<div class="mb-4">
			<label for="child-${childId}-dateOfBirth" class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">Date de naissance <span class="text-red-500">*</span></label>
			<input type="date" id="child-${childId}-dateOfBirth" value="${
    childData.dateOfBirth || ""
  }" 
				class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors">
		</div>
		<div class="mb-4">
			<label for="child-${childId}-allergies" class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">Allergies</label>
			<textarea id="child-${childId}-allergies" value="${childData.allergies || ""}" 
				class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-950 focus:border-transparent transition-colors resize-vertical min-h-[6rem] max-h-[12rem]"></textarea>
		</div>
		<label class="block text-sm font-medium font-[Inter] tracking-widest uppercase mb-2 text-gray-600 leading-relaxed">Programmes sélectionnés <span class="text-red-500">*</span></label> 
		<div class="space-y-2">
			${programs
        .map((program) => {
          const availability = programAvailability[program.programId];
          const isChecked =
            childData.programs &&
            childData.programs.includes(program.programId);

          return `
				<div class="relative rounded-lg border transition-all duration-200 border-gray-300 bg-white hover:bg-gray-50 hover:border-gray-400 cursor-pointer has-[:checked]:border-blue-950" data-program-container="${
          program.programId
        }">
					<div class="flex items-center p-4">
                        <input class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" 
							   type="checkbox" 
							   id="child-${childId}-program-${program.programId}"  
							   data-child-id="${childId}" 
							   data-program-id="${program.programId}"
							   ${isChecked ? "checked" : ""}>
						<div class="ml-4 flex-grow">
							<div class="flex flex-col-reverse lg:flex-row items-start lg:items-center justify-between">
								<h4 class="font-medium text-gray-900">${program.name}</h4>
								<div class="flex items-center gap-2">
									<span class="availability-indicator text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">${
                    availability.available
                  }/${availability.total} places</span>
								</div>
							</div>
							<p class="flex items-center gap-1 text-sm mt-1 text-gray-600">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
									<path d="M8 2v4"></path>
									<path d="M16 2v4"></path>
									<rect width="18" height="18" x="3" y="4" rx="2"></rect>
									<path d="M3 10h18"></path>
								</svg>
								Du ${program.startDate} au ${program.endDate}
							</p>
						</div>
					</div>
				</div>`;
        })
        .join("")}
		</div>
	`;

  container.appendChild(childForm);

  // Add event listeners after the form is added to the DOM
  addEventListenersToChildForm(childId, programs);
}

// Separate function to add event listeners
function addEventListenersToChildForm(childId, programs) {
  programs.forEach((program) => {
    const checkbox = document.getElementById(
      `child-${childId}-program-${program.programId}`
    );
    const container = checkbox?.closest("[data-program-container]");
    console.log(container);

    if (checkbox && container) {
      // Add change event listener to checkbox
      checkbox.addEventListener("change", function (e) {
        e.stopPropagation();
        const isChecked = e.target.checked;
        const programId = e.target.dataset.programId;
        const childId = parseInt(e.target.dataset.childId);

        container.classList.remove("border-red-500");

        updateProgramAvailability(childId, programId, isChecked);
      });

      // Add click event listener to container
      container.addEventListener("click", function (e) {
        if (e.target !== checkbox && !checkbox.disabled) {
          e.preventDefault();
          checkbox.click();
        }
      });

      // Prevent checkbox click from bubbling to container
      checkbox.addEventListener("click", function (e) {
        e.stopPropagation();
      });
    }
  });

  // Add event listeners for form fields
  addFormFieldListeners(childId);
}

// Function to add form field event listeners
function addFormFieldListeners(childId) {
  const firstNameInput = document.getElementById(`child-${childId}-firstName`);
  const lastNameInput = document.getElementById(`child-${childId}-lastName`);
  const dobInput = document.getElementById(`child-${childId}-dateOfBirth`);

  if (firstNameInput) {
    firstNameInput.addEventListener("blur", function () {
      validateField(`child-${childId}-firstName`);
      updateChildData(childId, "firstName", this.value);
    });
  }

  if (lastNameInput) {
    lastNameInput.addEventListener("blur", function () {
      validateField(`child-${childId}-lastName`);
      updateChildData(childId, "lastName", this.value);
    });
  }

  if (dobInput) {
    dobInput.addEventListener("blur", function () {
      validateField(`child-${childId}-dateOfBirth`);
      updateChildData(childId, "dateOfBirth", this.value);
    });
  }
}

// Helper function to update child program selection
function updateChildProgramSelection(childId, programId, isSelected) {
  const childIndex = children.findIndex((c) => c.id === childId);
  if (childIndex === -1) return;

  const child = children[childIndex];
  if (!child.programs) {
    child.programs = [];
  }

  const programIndex = child.programs.indexOf(programId);

  if (isSelected && programIndex === -1) {
    child.programs.push(programId);
  } else if (!isSelected && programIndex !== -1) {
    child.programs.splice(programIndex, 1);
  }

  // console.log(`Updated child ${childId} programs:`, child.programs);
}

// Helper function to update child data
function updateChildData(childId, field, value) {
  const childIndex = children.findIndex((c) => c.id === childId);
  if (childIndex === -1) return;

  children[childIndex][field] = value;
  // console.log(`Updated child ${childId} ${field}:`, value);
}

// Alternative approach using event delegation (more efficient for many elements)
function setupEventDelegation() {
  const container = document.getElementById("children-container");
  if (!container) return;

  // Use event delegation for all program checkboxes
  container.addEventListener("change", function (e) {
    if (e.target.type === "checkbox" && e.target.id.includes("-program-")) {
      const isChecked = e.target.checked;
      const programId = e.target.dataset.programId;
      const childId = parseInt(e.target.dataset.childId);

      // Call your program availability update function
      if (typeof updateProgramAvailability === "function") {
        updateProgramAvailability(childId, programId, isChecked);
      }

      // Update child data
      updateChildProgramSelection(childId, programId, isChecked);

      console.log(
        `Program ${programId} for child ${childId} is ${
          isChecked ? "selected" : "deselected"
        }`
      );
    }
  });

  // Handle container clicks
  container.addEventListener("click", function (e) {
    const programContainer = e.target.closest("[data-program-container]");
    if (programContainer) {
      const checkbox = programContainer.querySelector('input[type="checkbox"]');
      if (checkbox && e.target !== checkbox && !checkbox.disabled) {
        checkbox.click();
      }
    }
  });
}

// Generate payment summary
function generatePaymentSummary() {
  const container = document.getElementById("payment-summary");
  if (!container) return;

  const { subtotal, tps, tvq, total } = calculateTotals();

  container.innerHTML = `
		<div class="bg-gray-50 p-6 rounded-lg">
			<h3 class="text-lg font-semibold text-gray-900 mb-4">Résumé de la commande</h3>
			<div class="space-y-2 mb-4">
				${orderItems
          .map(
            (item) => `
					<div class="flex justify-between text-sm">
						<span>${item.name} (×${item.quantity})</span>
						<span>$${(item.price * item.quantity).toFixed(2)}</span>
					</div>
				`
          )
          .join("")}
			</div>
			<div class="border-t pt-4 space-y-2">
				<div class="flex justify-between text-sm">
					<span>Sous-total</span>
					<span>$${subtotal.toFixed(2)}</span>
				</div>
				<div class="flex justify-between text-sm">
					<span>TPS (5%)</span>
					<span>$${tps.toFixed(2)}</span>
				</div>
				<div class="flex justify-between text-sm">
					<span>TVQ (9.975%)</span>
					<span>$${tvq.toFixed(2)}</span>
				</div>
				<div class="flex justify-between text-lg font-semibold border-t pt-2">
					<span>Total</span>
					<span>$${total.toFixed(2)} CAD</span>
				</div>
			</div>
		</div>
	`;
}

// Show error message
function showError(message) {
  const errorElement = document.getElementById("error-message");
  if (errorElement) {
    errorElement.textContent = message;
    errorElement.style.display = "block";
    setTimeout(() => {
      errorElement.style.display = "none";
    }, 5000);
  } else {
    alert(message);
  }
}

// Show success message
function showSuccess(message) {
  const successElement = document.getElementById("success-message");
  if (successElement) {
    successElement.textContent = message;
    successElement.style.display = "block";
    setTimeout(() => {
      successElement.style.display = "none";
    }, 5000);
  } else {
    alert(message);
  }
}

// Process payment
function processPayment() {
  if (isProcessing) return;

  isProcessing = true;
  const submitButton = document.getElementById("submit-payment");
  if (submitButton) {
    submitButton.disabled = true;
    submitButton.textContent = "Traitement en cours...";
  }

  // Simulate payment processing
  setTimeout(() => {
    isProcessing = false;
    if (submitButton) {
      submitButton.disabled = false;
      submitButton.textContent = "Confirmer le paiement";
    }
    showSuccess("Paiement traité avec succès!");

    // Redirect or show confirmation
    setTimeout(() => {
      window.location.href = "/confirmation";
    }, 2000);
  }, 3000);
}

function initializeChildren() {
  const maxChildren = getMaxChildren();
  children = [];

  // Create empty child objects for each slot
  for (let i = 1; i <= maxChildren; i++) {
    children.push({
      id: i,
      firstName: "",
      lastName: "",
      dateOfBirth: "",
      allergies: "",
      programs: [], // This will track which programs each child has selected
    });
  }
}
// Initialize application
function initializeApp() {
  initializeProgramAvailability();
  initializeChildren();
  updateStepIndicators();
  updateOrderSummary();

  // Add event listeners for navigation buttons
  const nextButtons = document.querySelectorAll('[data-action="next"]');
  const prevButtons = document.querySelectorAll('[data-action="prev"]');
  const submitButton = document.getElementById("submit-payment");

  nextButtons.forEach((button) => {
    button.addEventListener("click", nextStep);
  });

  prevButtons.forEach((button) => {
    button.addEventListener("click", prevStep);
  });

  if (submitButton) {
    submitButton.addEventListener("click", processPayment);
  }

  $("#cc-number").payment("formatCardNumber");
  $("#cc-exp").payment("formatCardExpiry");
  $("#cc-cvc").payment("formatCardCVC");

  $("#checkout-form").on("submit", function (e) {
    e.preventDefault();
    var cardType = $.payment.cardType($("#cc-number").val());
    let validNumber = $.payment.validateCardNumber($("#cc-number").val());
    let validExpiry = $.payment.validateCardExpiry($("#cc-exp").val());
    let validCVC = $.payment.validateCardCVC($("#cc-cvc").val(), cardType);

    console.log($.payment.validateCardExpiry("10-27"));

    console.log("Number:", $("#cc-number").val(), "Valid:", validNumber);
    console.log("Expiry:", $("#cc-exp").val(), "Valid:", validExpiry);
    console.log("CVC:", $("#cc-cvc").val(), "Valid:", validCVC);

    if (validNumber && validExpiry && validCVC) {
      processPayment();
    } else {
      showError("Veuillez vérifier les informations de votre carte.");
    }
  });

  $(document).ready(function () {
    $("#firstName").on("blur", function () {
      validateField("firstName");
    });

    $("#lastName").on("blur", function () {
      validateField("lastName");
    });

    $("#email").on("blur", function () {
      validateField("email");
    });

    $("#phone").on("blur", function () {
      validateField("phone");
    });
  });
}

// Helper function to calculate age from date of birth
function calculateAgeAtDate(dateOfBirth, targetDate) {
  // Parse as local date to avoid timezone issues
  const [year, month, day] = dateOfBirth.split("-").map(Number);
  const checkDate = new Date(targetDate);
  const birthDate = new Date(year, month - 1, day); // month is 0-indexed
  let age = checkDate.getFullYear() - birthDate.getFullYear();
  const monthDiff = checkDate.getMonth() - birthDate.getMonth();

  if (
    monthDiff < 0 ||
    (monthDiff === 0 && checkDate.getDate() < birthDate.getDate())
  ) {
    age--;
  }

  return age;
}

// Helper function to get date range for a child's selected programs
function getDateRangeForChild(childId) {
  const child = children.find((c) => c.id === childId);
  if (!child || !child.programs || child.programs.length === 0) {
    return null;
  }

  let earliestStart = null;
  let latestEnd = null;
  let programNames = [];

  // Get date ranges from all selected programs for this child
  child.programs.forEach((programId) => {
    const orderItem = orderItems.find((item) => item.programId === programId);
    if (orderItem) {
      // Adjust these property names based on your actual data structure
      const programStartDate =
        orderItem.start_date || orderItem.startDate || orderItem.program_start;
      const programEndDate =
        orderItem.end_date || orderItem.endDate || orderItem.program_end;

      if (programStartDate) {
        const startDate = new Date(programStartDate);
        if (!earliestStart || startDate < earliestStart) {
          earliestStart = startDate;
        }
      }

      if (programEndDate) {
        const endDate = new Date(programEndDate);
        if (!latestEnd || endDate > latestEnd) {
          latestEnd = endDate;
        }
      }

      programNames.push(orderItem.programName);
    }
  });
  programNames.sort();
  // If no valid date ranges found, return null
  if (!earliestStart && !latestEnd) {
    return null;
  }

  return {
    startDate: earliestStart,
    endDate: latestEnd,
    programs: programNames,
  };
}

// Helper function to get age range for a child's selected programs
function getAgeRangeForChild(childId) {
  const child = children.find((c) => c.id === childId);
  if (!child || !child.programs || child.programs.length === 0) {
    return null;
  }

  let minAge = Infinity;
  let maxAge = -Infinity;
  let programNames = [];

  // Get age ranges from all selected programs for this child
  child.programs.forEach((programId) => {
    const orderItem = orderItems.find((item) => item.programId === programId);
    if (orderItem && orderItem.ageRange) {
      const ageRange = orderItem.ageRange;

      // Assuming ageRange is an object with min and max properties
      // Adjust these property names based on your actual ACF field structure
      const programMinAge = ageRange.min || ageRange.minimum || ageRange.from;
      const programMaxAge = ageRange.max || ageRange.maximum || ageRange.to;

      if (programMinAge !== undefined && programMinAge < minAge) {
        minAge = programMinAge;
      }
      if (programMaxAge !== undefined && programMaxAge > maxAge) {
        maxAge = programMaxAge;
      }

      programNames.push(orderItem.programName);
    }
  });
  programNames.sort();
  // If no valid age ranges found, return null
  if (minAge === Infinity || maxAge === -Infinity) {
    return null;
  }

  return {
    min: minAge,
    max: maxAge,
    programs: programNames,
  };
}

// Enhanced validateField function with age range validation
function validateField(fieldId) {
  // Clear previous error for this field
  $(`#${fieldId}`).removeClass("border-red-500");
  $(`#${fieldId}`).next(".error-message").remove();

  function showError(message) {
    $(`#${fieldId}`).addClass("border-red-500");
    $(`#${fieldId}`).after(
      `<div class="error-message text-red-500 text-sm mt-1">${message}</div>`
    );
  }

  const value = $(`#${fieldId}`).val().trim();

  switch (true) {
    case fieldId.includes("firstName"):
      if (!value) {
        showError("Le prénom est requis");
        return false;
      }
      break;

    case fieldId.includes("lastName"):
      if (!value) {
        showError("Le nom de famille est requis");
        return false;
      }
      break;

    case fieldId === "email":
      if (!value) {
        showError("L'adresse courriel est requise");
        return false;
      } else {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
          showError("Veuillez entrer une adresse courriel valide");
          return false;
        }
      }
      break;

    case fieldId === "phone":
      if (!value) {
        showError("Le numéro de téléphone est requis");
        return false;
      } else {
        const phoneRegex =
          /^[\+]?[1]?[\s\-\.]?\(?([0-9]{3})\)?[\s\-\.]?([0-9]{3})[\s\-\.]?([0-9]{4})$/;
        if (!phoneRegex.test(value)) {
          showError("Veuillez entrer un numéro de téléphone valide");
          return false;
        }
      }
      break;

    case fieldId.includes("dateOfBirth"):
      if (!value) {
        showError("La date de naissance est requise");
        return false;
      }

      // Check if date is in the future
      const today = new Date();
      const birthDate = new Date(value);

      if (birthDate > today) {
        showError("La date de naissance ne peut pas être dans le futur");
        return false;
      }

      // Extract child ID from field ID (e.g., "child-1-dateOfBirth" -> 1)
      const childIdMatch = fieldId.match(/child-(\d+)-dateOfBirth/);
      if (childIdMatch) {
        const childId = parseInt(childIdMatch[1]);
        const dateRange = getDateRangeForChild(childId);
        console.log(dateRange);
        // Add safety check here
        if (!dateRange || !dateRange.startDate) {
          return true; // or handle this case as needed
        }

        const childAge = calculateAgeAtDate(value, today.toString());

        // Get age range for this child's selected programs
        const ageRange = getAgeRangeForChild(childId);

        if (ageRange) {
          if (childAge < ageRange.min || childAge > ageRange.max) {
            showError(
              `L'âge de l'enfant (${childAge} ans) ne correspond pas à la tranche d'âge requise (${
                ageRange.min
              }-${
                ageRange.max
              } ans) pour la date de début du ou des programme(s) sélectionné(s) :
                <ul class="list-disc list-inside">
                ${ageRange.programs
                  .map((program) => `<li>${program}</li>`)
                  .join("")}
                </ul>`
            );
            return false;
          }
        }
      }
      break;
  }

  return true;
}

document.addEventListener("DOMContentLoaded", initializeApp);
