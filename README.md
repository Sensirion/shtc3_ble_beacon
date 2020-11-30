# SHTC3 BLE Beacon
Small CR2032 battery driven BLE beacon with Sensirion's humidity and temperature sensor

## Clone this repository
```
git clone --recursive https://github.com/Sensirion/shtc3_ble_beacon.git
```

## Repository content
* firmware (hex files and source code to program the microcontroller)
* schematics (schematics, PCB layout and gerber files)
* housing (STEP file for the housing parts)
* software (software to read out the beacon data with a Raspberry Pi)

## Firmware
The firmware is based on the example of nordics ble_app_beacon in their nRF SDK. So only the modified files are in this repository. 

* To create your own verison of the firmware install the nRF5 SDK v17 from nordic https://www.nordicsemi.com/Software-and-tools/Software/nRF5-SDK/Download#infotabs
* You might want to install the nRF command line tools as well to flash the firmware and the softdevice https://infocenter.nordicsemi.com/index.jsp?topic=%2Fug_nrf52840_dk%2FUG%2Fcommon%2Fnordic_tools.html
* In addition you have to install the arm cross compiler in version gcc-arm-none-eabi-7-2018-q2-update https://developer.arm.com/tools-and-software/open-source-software/developer-tools/gnu-toolchain/gnu-rm/downloads

Afterwards unzip the SDK. Go to the directory nRF5_SDK_17.0.2/examples/ble_peripheral/ble_app_beacon and replace the file "main.c" and add "shtc3.h" and "shtc3.c". Afterwards broswse the subfolder nRF5_SDK_17.0.2/examples/ble_peripheral/ble_app_beacon/pca10040/s132/config and replace the "sdk_config.h". 
As this example was tested with the armgcc replace the Makefile in the subfolder nRF5_SDK_17.0.2/examples/ble_peripheral/ble_app_beacon/pca10040/s132/armgcc.
If you prefer another compiler you have to include the following files to the example.
 * $(SDK_ROOT)/components/ble/ble_advertising/ble_advertising.c \
 * $(SDK_ROOT)/integration/nrfx/legacy/nrf_drv_twi.c \
 * $(SDK_ROOT)/modules/nrfx/drivers/src/nrfx_twi.c \
 * $(SDK_ROOT)/modules/nrfx/drivers/src/nrfx_twim.c \
 * $(PROJ_DIR)/shtc3.c \

