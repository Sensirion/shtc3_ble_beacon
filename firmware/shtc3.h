#ifndef SHTC3_H__
#define SHTC3_H__

#include "nordic_common.h"
//#include "nrf.h"
#include "boards.h"
#include "nrf_drv_twi.h"
#include "app_util_platform.h"

/* TWI instance ID. */
#define TWI_INSTANCE_ID 0
#define SHTC3_ADDRESS 0x70

static const float _1_65535 = 1.0f / 65535.0f; /* used for ticks to temperature */
static const float _100_DIV_65535 = 100.0f / 65535.0f; /* used for ticks to humidity */

/* Indicates if operation on TWI has ended. */
static volatile bool m_xfer_done = false;
/* TWI instance. */
static const nrf_drv_twi_t m_twi = NRF_DRV_TWI_INSTANCE(TWI_INSTANCE_ID);

uint8_t m_sample[6];

void twi_handler(nrf_drv_twi_evt_t const * p_event, void * p_context);
void twi_init (void);

void shtc3_start_measurement(void);
void shtc3_read_measurement(void);

#define POLYNOMIAL  0x131u /* P(x) = x^8 + x^5 + x^4 + 1 = 100110001 */
uint8_t CalculateCrc(uint8_t data[], uint8_t numBytes);
ret_code_t shtc3_get_rht_raw(uint16_t* humidityticks, uint16_t* temperatureticks);

#endif //SHTC3_H__
